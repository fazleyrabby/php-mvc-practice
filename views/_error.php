<?php 
/**
 * @var $exception = \Exception
 */
?>

<div class="px-4 d-flex justify-content-center align-items-center" style="height: 80vh;">
<h2 class="pb-2 text-danger"><?=$exception->getCode()?> | <?=$exception->getMessage()?></h2>
</div>

