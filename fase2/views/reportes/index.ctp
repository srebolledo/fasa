<div class="tworeports index">
	<h2><?php __('Tworeports');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('engineer_id');?></th>
			<th><?php echo $this->Paginator->sort('semana');?></th>
			<th><?php echo $this->Paginator->sort('fecha');?></th>
			<th><?php echo $this->Paginator->sort('activity_id');?></th>
			<th><?php echo $this->Paginator->sort('emsefor_id');?></th>
			<th><?php echo $this->Paginator->sort('cuadrilla');?></th>
			<th><?php echo $this->Paginator->sort('unity_id');?></th>
			<th><?php echo $this->Paginator->sort('contacto');?></th>
			<th><?php echo $this->Paginator->sort('lugar');?></th>
			<th><?php echo $this->Paginator->sort('state_id');?></th>
			<th><?php echo $this->Paginator->sort('tema');?></th>
			<th><?php echo $this->Paginator->sort('parent');?></th>
			<th><?php echo $this->Paginator->sort('order');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tworeports as $tworeport):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $tworeport['Tworeport']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tworeport['Engineer']['nombre'], array('controller' => 'engineers', 'action' => 'view', $tworeport['Engineer']['id'])); ?>
		</td>
		<td><?php echo $tworeport['Tworeport']['semana']; ?>&nbsp;</td>
		<td><?php echo $tworeport['Tworeport']['fecha']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tworeport['Activity']['nombre'], array('controller' => 'activities', 'action' => 'view', $tworeport['Activity']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($tworeport['Emsefor']['nombre'], array('controller' => 'emsefors', 'action' => 'view', $tworeport['Emsefor']['id'])); ?>
		</td>
		<td><?php echo $tworeport['Tworeport']['cuadrilla']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tworeport['Unity']['nombre'], array('controller' => 'unities', 'action' => 'view', $tworeport['Unity']['id'])); ?>
		</td>
		<td><?php echo $tworeport['Tworeport']['contacto']; ?>&nbsp;</td>
		<td><?php echo $tworeport['Tworeport']['lugar']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($tworeport['State']['nombre'], array('controller' => 'states', 'action' => 'view', $tworeport['State']['id'])); ?>
		</td>
		<td><?php echo $tworeport['Tworeport']['tema']; ?>&nbsp;</td>
		<td><?php echo $tworeport['Tworeport']['parent']; ?>&nbsp;</td>
		<td><?php echo $tworeport['Tworeport']['order']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $tworeport['Tworeport']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $tworeport['Tworeport']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $tworeport['Tworeport']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tworeport['Tworeport']['id'])); ?>
			
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
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Engineers', true), array('controller' => 'engineers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Engineer', true), array('controller' => 'engineers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities', true), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity', true), array('controller' => 'activities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('controller' => 'emsefors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('controller' => 'emsefors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities', true), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity', true), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List States', true), array('controller' => 'states', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New State', true), array('controller' => 'states', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Minutas', true), array('controller' => 'minutas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Minuta', true), array('controller' => 'minutas', 'action' => 'add')); ?> </li>
	</ul>
</div>
