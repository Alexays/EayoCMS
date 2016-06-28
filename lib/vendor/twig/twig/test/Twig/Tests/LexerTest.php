<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Tests_LexerTest extends PHPUnit_Framework_TestCase
{
    public function testNameLabelForTag()
    {
        $theme_url = '{% § %}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);

        $stream->expect(Twig_Token::BLOCK_START_TYPE);
        $this->assertSame('§', $stream->expect(Twig_Token::NAME_TYPE)->getValue());
    }

    public function testNameLabelForFunction()
    {
        $theme_url = '{{ §() }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);

        $stream->expect(Twig_Token::VAR_START_TYPE);
        $this->assertSame('§', $stream->expect(Twig_Token::NAME_TYPE)->getValue());
    }

    public function testBracketsNesting()
    {
        $theme_url = '{{ {"a":{"b":"c"}} }}';

        $this->assertEquals(2, $this->countToken($theme_url, Twig_Token::PUNCTUATION_TYPE, '{'));
        $this->assertEquals(2, $this->countToken($theme_url, Twig_Token::PUNCTUATION_TYPE, '}'));
    }

    protected function countToken($theme_url, $type, $value = null)
    {
        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);

        $count = 0;
        while (!$stream->isEOF()) {
            $token = $stream->next();
            if ($type === $token->getType()) {
                if (null === $value || $value === $token->getValue()) {
                    ++$count;
                }
            }
        }

        return $count;
    }

    public function testLineDirective()
    {
        $theme_url = "foo\n"
            ."bar\n"
            ."{% line 10 %}\n"
            ."{{\n"
            ."baz\n"
            ."}}\n";

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);

        // foo\nbar\n
        $this->assertSame(1, $stream->expect(Twig_Token::TEXT_TYPE)->getLine());
        // \n (after {% line %})
        $this->assertSame(10, $stream->expect(Twig_Token::TEXT_TYPE)->getLine());
        // {{
        $this->assertSame(11, $stream->expect(Twig_Token::VAR_START_TYPE)->getLine());
        // baz
        $this->assertSame(12, $stream->expect(Twig_Token::NAME_TYPE)->getLine());
    }

    public function testLineDirectiveInline()
    {
        $theme_url = "foo\n"
            ."bar{% line 10 %}{{\n"
            ."baz\n"
            ."}}\n";

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);

        // foo\nbar
        $this->assertSame(1, $stream->expect(Twig_Token::TEXT_TYPE)->getLine());
        // {{
        $this->assertSame(10, $stream->expect(Twig_Token::VAR_START_TYPE)->getLine());
        // baz
        $this->assertSame(11, $stream->expect(Twig_Token::NAME_TYPE)->getLine());
    }

    public function testLongComments()
    {
        $theme_url = '{# '.str_repeat('*', 100000).' #}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $lexer->tokenize($theme_url);

        // should not throw an exception
    }

    public function testLongVerbatim()
    {
        $theme_url = '{% verbatim %}'.str_repeat('*', 100000).'{% endverbatim %}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $lexer->tokenize($theme_url);

        // should not throw an exception
    }

    public function testLongVar()
    {
        $theme_url = '{{ '.str_repeat('x', 100000).' }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $lexer->tokenize($theme_url);

        // should not throw an exception
    }

    public function testLongBlock()
    {
        $theme_url = '{% '.str_repeat('x', 100000).' %}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $lexer->tokenize($theme_url);

        // should not throw an exception
    }

    public function testBigNumbers()
    {
        $theme_url = '{{ 922337203685477580700 }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);
        $stream->next();
        $node = $stream->next();
        $this->assertEquals('922337203685477580700', $node->getValue());
    }

    public function testStringWithEscapedDelimiter()
    {
        $tests = array(
            "{{ 'foo \' bar' }}" => 'foo \' bar',
            '{{ "foo \" bar" }}' => 'foo " bar',
        );
        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        foreach ($tests as $theme_url => $expected) {
            $stream = $lexer->tokenize($theme_url);
            $stream->expect(Twig_Token::VAR_START_TYPE);
            $stream->expect(Twig_Token::STRING_TYPE, $expected);
        }
    }

    public function testStringWithInterpolation()
    {
        $theme_url = 'foo {{ "bar #{ baz + 1 }" }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);
        $stream->expect(Twig_Token::TEXT_TYPE, 'foo ');
        $stream->expect(Twig_Token::VAR_START_TYPE);
        $stream->expect(Twig_Token::STRING_TYPE, 'bar ');
        $stream->expect(Twig_Token::INTERPOLATION_START_TYPE);
        $stream->expect(Twig_Token::NAME_TYPE, 'baz');
        $stream->expect(Twig_Token::OPERATOR_TYPE, '+');
        $stream->expect(Twig_Token::NUMBER_TYPE, '1');
        $stream->expect(Twig_Token::INTERPOLATION_END_TYPE);
        $stream->expect(Twig_Token::VAR_END_TYPE);
    }

    public function testStringWithEscapedInterpolation()
    {
        $theme_url = '{{ "bar \#{baz+1}" }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);
        $stream->expect(Twig_Token::VAR_START_TYPE);
        $stream->expect(Twig_Token::STRING_TYPE, 'bar #{baz+1}');
        $stream->expect(Twig_Token::VAR_END_TYPE);
    }

    public function testStringWithHash()
    {
        $theme_url = '{{ "bar # baz" }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);
        $stream->expect(Twig_Token::VAR_START_TYPE);
        $stream->expect(Twig_Token::STRING_TYPE, 'bar # baz');
        $stream->expect(Twig_Token::VAR_END_TYPE);
    }

    /**
     * @expectedException Twig_Error_Syntax
     * @expectedExceptionMessage Unclosed """
     */
    public function testStringWithUnterminatedInterpolation()
    {
        $theme_url = '{{ "bar #{x" }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $lexer->tokenize($theme_url);
    }

    public function testStringWithNestedInterpolations()
    {
        $theme_url = '{{ "bar #{ "foo#{bar}" }" }}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);
        $stream->expect(Twig_Token::VAR_START_TYPE);
        $stream->expect(Twig_Token::STRING_TYPE, 'bar ');
        $stream->expect(Twig_Token::INTERPOLATION_START_TYPE);
        $stream->expect(Twig_Token::STRING_TYPE, 'foo');
        $stream->expect(Twig_Token::INTERPOLATION_START_TYPE);
        $stream->expect(Twig_Token::NAME_TYPE, 'bar');
        $stream->expect(Twig_Token::INTERPOLATION_END_TYPE);
        $stream->expect(Twig_Token::INTERPOLATION_END_TYPE);
        $stream->expect(Twig_Token::VAR_END_TYPE);
    }

    public function testStringWithNestedInterpolationsInBlock()
    {
        $theme_url = '{% foo "bar #{ "foo#{bar}" }" %}';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);
        $stream->expect(Twig_Token::BLOCK_START_TYPE);
        $stream->expect(Twig_Token::NAME_TYPE, 'foo');
        $stream->expect(Twig_Token::STRING_TYPE, 'bar ');
        $stream->expect(Twig_Token::INTERPOLATION_START_TYPE);
        $stream->expect(Twig_Token::STRING_TYPE, 'foo');
        $stream->expect(Twig_Token::INTERPOLATION_START_TYPE);
        $stream->expect(Twig_Token::NAME_TYPE, 'bar');
        $stream->expect(Twig_Token::INTERPOLATION_END_TYPE);
        $stream->expect(Twig_Token::INTERPOLATION_END_TYPE);
        $stream->expect(Twig_Token::BLOCK_END_TYPE);
    }

    public function testOperatorEndingWithALetterAtTheEndOfALine()
    {
        $theme_url = "{{ 1 and\n0}}";

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $stream = $lexer->tokenize($theme_url);
        $stream->expect(Twig_Token::VAR_START_TYPE);
        $stream->expect(Twig_Token::NUMBER_TYPE, 1);
        $stream->expect(Twig_Token::OPERATOR_TYPE, 'and');
    }

    /**
     * @expectedException Twig_Error_Syntax
     * @expectedExceptionMessage Unclosed "variable" at line 3
     */
    public function testUnterminatedVariable()
    {
        $theme_url = '

{{

bar


';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $lexer->tokenize($theme_url);
    }

    /**
     * @expectedException Twig_Error_Syntax
     * @expectedExceptionMessage Unclosed "block" at line 3
     */
    public function testUnterminatedBlock()
    {
        $theme_url = '

{%

bar


';

        $lexer = new Twig_Lexer(new Twig_Environment($this->getMock('Twig_LoaderInterface')));
        $lexer->tokenize($theme_url);
    }
}
