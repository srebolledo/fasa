<div class="onereporthistories index">
	<h2><?php __('Onereporthistories');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('onereport_id');?></th>
			<th><?php echo $this->Paginator->sort('indicador');?></th>
			<th><?php echo $this->Paginator->sort('eanterior');?></th>
			<th><?php echo $this->Paginator->sort('esiguiente');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($onereporthistories as $onereporthistory):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $onereporthistory['Onereporthistory']['id']; ?>&nbsp;</td>
		<td><?php echo $onereporthistory['Onereporthistory']['onereport_id']; ?>&nbsp;</td>
		<td><?php echo $onereporthistory['Onereporthistory']['indicador']; ?>&nbsp;</td>
		<td><?php echo $onereporthistory['Onereporthistory']['eanterior']; ?>&nbsp;</td>
		<td><?php echo $onereporthistory['Onereporthistory']['esiguiente']; ?>&nbsp;</td>
		<td><?php echo $onereporthistory['Onereporthistory']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $onereporthistory['Onereporthistory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $onereporthistory['Onereporthistory']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $onereporthistory['Onereporthistory']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $onereporthistory['Onereporthistory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Onereporthistory', true), array('action' => 'add')); ?></li>
	</ul>
</div>