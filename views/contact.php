<?php
use App\Core\Form\Form;
use App\Core\Form\Select;
use App\Core\Form\TextAreaField;

$this->title = 'Contact';
?>
<div class="px-4 py-2">
<h2 class="pb-2 border-bottom">Contact</h2>
<form action="/contact" method="post">
<?php $form=Form::begin('','post'); ?>
  <?=$form->field($model, 'subject')?>
  <?=$form->field($model, 'email')?>
  <?=new TextAreaField($model, 'body')?>
  <?php //new Select($model, 'select', ['1' => 'Option1', '2' => 'Option2']);?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
</form>
</div>

