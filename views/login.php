<?php
/**
 * @var $model \App\Models\User
 */
use App\Core\Form\Form;
$form = new Form();

?>

<div class="px-4 py-2">
<h2 class="pb-2 border-bottom">Login</h2>
<?php $form=Form::begin('','post'); ?>
  <?=$form->field($model, 'email')?>
  <?=$form->field($model, 'password')->passwordField()?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
</div>

