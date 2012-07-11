<div class="minutas index">
	<h2><?php __('Minutas');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fecha');?></th>
			<th><?php echo $this->Paginator->sort('observaciones');?></th>
			<th><?php echo $this->Paginator->sort('tworeport_id');?></th>
			<th><?php echo $this->Paginator->sort('opened');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($minutas as $minuta):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $minuta['Minuta']['id']; ?>&nbsp;</td>
		<td><?php echo $minuta['Minuta']['fecha']; ?>&nbsp;</td>
		<td><?php echo $minuta['Minuta']['observaciones']; ?>&nbsp;</td>

		<td>
			<?php echo $this->Html->link($minuta['Tworeport']['id'], array('controller' => 'tworeports', 'action' => 'view', $minuta['Tworeport']['id'])); ?>
		</td>
		<td><?php echo $minuta['Minuta']['opened']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $minuta['Minuta']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $minuta['Minuta']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $minuta['Minuta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $minuta['Minuta']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Minuta', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants', true), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant', true), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tdsubjects', true), array('controller' => 'tdsubjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tdsubject', true), array('controller' => 'tdsubjects', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tsubjects', true), array('controller' => 'tsubjects', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tsubject', true), array('controller' => 'tsubjects', 'action' => 'add')); ?> </li>
	</ul>
</div>
