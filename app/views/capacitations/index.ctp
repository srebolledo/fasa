<div class="capacitations index">
	<h2><?php __('Capacitations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('fecha');?></th>
			<th><?php echo $this->Paginator->sort('filial_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($capacitations as $capacitation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $capacitation['Capacitation']['id']; ?>&nbsp;</td>
		<td><?php echo $capacitation['Capacitation']['fecha']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($capacitation['Filial']['nombre'], array('controller' => 'filials', 'action' => 'view', $capacitation['Filial']['id'])); ?>
		</td>
		<td><?php echo $capacitation['Capacitation']['created']; ?>&nbsp;</td>
		<td><?php echo $capacitation['Capacitation']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $capacitation['Capacitation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $capacitation['Capacitation']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $capacitation['Capacitation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $capacitation['Capacitation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Capacitation', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('controller' => 'filials', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Filial', true), array('controller' => 'filials', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Capasists', true), array('controller' => 'capasists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Capasist', true), array('controller' => 'capasists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Relators', true), array('controller' => 'relators', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Relator', true), array('controller' => 'relators', 'action' => 'add')); ?> </li>
	</ul>
</div>