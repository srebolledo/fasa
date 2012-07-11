<div class="minutas view">
<h2><?php  __('Minuta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $minuta['Minuta']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Fecha'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $minuta['Minuta']['fecha']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Observaciones'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $minuta['Minuta']['observaciones']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tworeport'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($minuta['Tworeport']['id'], array('controller' => 'tworeports', 'action' => 'view', $minuta['Tworeport']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Opened'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $minuta['Minuta']['opened']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Participantes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $minuta['Minuta']['participantes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Temas A Tratar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $minuta['Minuta']['temas_a_tratar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Acuerdos'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $minuta['Minuta']['acuerdos']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Minuta', true), array('action' => 'edit', $minuta['Minuta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Minuta', true), array('action' => 'delete', $minuta['Minuta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $minuta['Minuta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Minutas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Minuta', true), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php __('Related Participants');?></h3>
	<?php if (!empty($minuta['Participant'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Nombre'); ?></th>
		<th><?php __('Apellido'); ?></th>
		<th><?php __('Position Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($minuta['Participant'] as $participant):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $participant['id'];?></td>
			<td><?php echo $participant['nombre'];?></td>
			<td><?php echo $participant['apellido'];?></td>
			<td><?php echo $participant['position_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'participants', 'action' => 'view', $participant['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'participants', 'action' => 'edit', $participant['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'participants', 'action' => 'delete', $participant['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $participant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Participant', true), array('controller' => 'participants', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Tdsubjects');?></h3>
	<?php if (!empty($minuta['Tdsubject'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Descripcion'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($minuta['Tdsubject'] as $tdsubject):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $tdsubject['id'];?></td>
			<td><?php echo $tdsubject['descripcion'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'tdsubjects', 'action' => 'view', $tdsubject['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'tdsubjects', 'action' => 'edit', $tdsubject['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'tdsubjects', 'action' => 'delete', $tdsubject['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tdsubject['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tdsubject', true), array('controller' => 'tdsubjects', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Tsubjects');?></h3>
	<?php if (!empty($minuta['Tsubject'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Descripcion'); ?></th>
		<th><?php __('Tiempo'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($minuta['Tsubject'] as $tsubject):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $tsubject['id'];?></td>
			<td><?php echo $tsubject['descripcion'];?></td>
			<td><?php echo $tsubject['tiempo'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'tsubjects', 'action' => 'view', $tsubject['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'tsubjects', 'action' => 'edit', $tsubject['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'tsubjects', 'action' => 'delete', $tsubject['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tsubject['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tsubject', true), array('controller' => 'tsubjects', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
