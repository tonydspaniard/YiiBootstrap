<fieldset>

    <legend><?php echo CHtml::encode($language); ?> translation</legend>

    <?php echo $form->textFieldRow($model, "[{$locale}]textField"); ?>
    <?php echo $form->textAreaRow($model, "[{$locale}]textarea", array('class'=>'span8', 'rows'=>8)); ?>
    <?php echo $form->checkBoxListRow($model, "[{$locale}]checkboxes", array(
        'Option one is this and that—be sure to include why it\'s great',
        'Option two can also be checked and included in form results',
        'Option three can—yes, you guessed it—also be checked and included in form results',
    ), array('hint'=>'<strong>Note:</strong> Labels surround all the options for much larger click areas.')); ?>

</fieldset>