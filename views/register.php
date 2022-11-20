<div class="px-4 py-2">
<h2 class="pb-2 border-bottom">Register</h2>
<?php $form=\App\Core\Form\Form::begin('','post'); ?>
  <?=$form->field($model, 'name')?>
  <?=$form->field($model, 'email')?>
  <?=$form->field($model, 'password')->passwordField()?>
  <?=$form->field($model, 'confirmedPassword')->passwordField()?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php \App\Core\Form\Form::end(); ?>
</div>

