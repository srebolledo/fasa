<div class="docents index">
	<h2><?php __('Docents');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('apellido');?></th>
			<th><?php echo $this->Paginator->sort('emsefor_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($docents as $docent):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $docent['Docent']['id']; ?>&nbsp;</td>
		<td><?php echo $docent['Docent']['nombre']; ?>&nbsp;</td>
		<td><?php echo $docent['Docent']['apellido']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($docent['Emsefor']['nombre'], array('controller' => 'emsefors', 'action' => 'view', $docent['Emsefor']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $docent['Docent']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $docent['Docent']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $docent['Docent']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $docent['Docent']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Docent', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('controller' => 'emsefors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('controller' => 'emsefors', 'action' => 'add')); ?> </li>
	</ul>
</div>