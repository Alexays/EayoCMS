<!DOCTYPE html>
<html>
<head>
    <title>Eayo Development Error Handler</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo $base_url;?>/lib/Core/ErrorHandler/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div class="main">
    <div class="header">Eayo Development Error Handler</div>
    <div class="body">
        <h2>Une erreur de type "<?php echo $type ?>" s'est produite :(</h2>
        <p>
            <strong>
                <?= $exception_message ?> [<?= $exception_code ?>]
            </strong>
			<br />
            <span class="exception"><?= $exception_class ?></span>
			triggered in file
            <span class="file">
                <?= $exception_file ?></span> on line <span class="line"><?= $exception_line ?>
            </span>.
        </p>
        <?= $exception_fragment ?>
		<?php if (isset($exception_backtrace)) : ?>
			<h2>Backtrace</h2>
    <?= $exception_backtrace ?>
    <?php
endif; ?>
    </div>
</div>
</body>
</html>
