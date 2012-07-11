<div class="businessstates index">
	<h2><?php __('Businessstates');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('acronimo');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($businessstates as $businessstate):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $businessstate['Businessstate']['id']; ?>&nbsp;</td>
		<td><?php echo $businessstate['Businessstate']['nombre']; ?>&nbsp;</td>
		<td><?php echo $businessstate['Businessstate']['acronimo']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $businessstate['Businessstate']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $businessstate['Businessstate']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $businessstate['Businessstate']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $businessstate['Businessstate']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Businessstate', true), array('action' => 'add')); ?></li>
	</ul>
</div>