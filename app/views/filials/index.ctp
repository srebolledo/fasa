<div class="filials index">
	<h2><?php __('Filials');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('lugar');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($filials as $filial):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $filial['Filial']['id']; ?>&nbsp;</td>
		<td><?php echo $filial['Filial']['nombre']; ?>&nbsp;</td>
		<td><?php echo $filial['Filial']['lugar']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $filial['Filial']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $filial['Filial']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $filial['Filial']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $filial['Filial']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Filial', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Engineers', true), array('controller' => 'engineers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Engineer', true), array('controller' => 'engineers', 'action' => 'add')); ?> </li>
	</ul>
</div>