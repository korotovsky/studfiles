<?php
$this->breadcrumbs = array(
	'Администрирование' => array('admin/index'),
	'Категории',
);?>

<div class="view fw">
	<h1>Управление категориями</h1>
	<br />
	<div class="p-10">
		<p>Для управления категорями, сначала выберите ее из списка, а затем нажмите соответствующую кнопку действия.</p>

		<?php echo CHtml::beginForm(); ?>
			<?php echo CHtml::hiddenField('tree', 'manage'); ?>
			<div class="fl">
				<?php echo CHtml::listBox('node', '1', $data, array('size' => '15', 'style' => 'width: 180p; height: 150px')); ?>
			</div>
			<div class="fl inp p-10-l">
				<?php echo CHtml::textField('name'); ?>
				<?php echo CHtml::submitButton('Добавить', array('name' => 'add')); ?><br />

				<?php echo CHtml::textField('newname'); ?>
				<?php echo CHtml::submitButton('Переименовать', array('name' => 'rename')); ?><br />
				<br /><hr /><br />
				<?php echo CHtml::submitButton('Удалить категорию', array('name' => 'delete')); ?><br />
				<?php echo CHtml::submitButton('Переместить выше', array('name' => 'up')); ?><br />
				<?php echo CHtml::submitButton('Переместить ниже', array('name' => 'down')); ?><br />
				<br /><hr /><br />
				<?php echo CHtml::submitButton('Переместить перед', array('name' => 'before')); ?>
				<?php echo CHtml::submitButton('Переместить в категорию', array('name' => 'below')); ?>
				<?php echo CHtml::dropDownList('nodeto', '1', $data); ?>
			</div>
			<br /><br />

		<?php echo CHtml::endForm(); ?>
	</div>

</div>
