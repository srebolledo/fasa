<div class="emsefors view">
	<div id="box">
		<div id="leftside">
			<label>IDI</label>
			<?php echo $emsefor['Emsefor']['id']; ?>
			<label>Nombre Fantasía</label>
			<?php echo $emsefor['Emsefor']['nombre']; ?>
			<label>Nombre Real</label>
			<?php echo $emsefor['Emsefor']['nombre_real']; ?>
			<label>Código SAP</label>
			<?php echo $emsefor['Emsefor']['lugar']; ?>
			<label>Encargado EO</label>
			<?php echo $emsefor['Emsefor']['contacto']; ?>
		</div>
		
		<div id="rightside">
		<label>Trabajadores</label>
			<?php echo $emsefor['Emsefor']['trabajadores']; ?>
		<label>Unidad</label>
			<?php echo $emsefor['Unity']['nombre']; ?>
		<label>Filial</label>
			<?php echo $emsefor['Filial']['nombre']; ?>

		</div>
	</div>
	
	<div id="box">
			<div id="acciones">
				<?php echo $this->Html->link(__('Editar', true), array('controller' => 'emsefors', 'action' => 'edit', $emsefor['Emsefor']['id'])); ?>
			</div>
	</div>
	<div id="box">
	<h3><?php __('Ideas/Proyectos relacionados	');?></h3>
	<?php // if (!empty($emsefor['Onereport'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th>Ingeniero</th>
		<th><?php __('Fecha'); ?></th>
		<th><?php __('Trabajador'); ?></th>
		<th><?php __('Indicador'); ?></th>
		<th><?php __('Resumen'); ?></th>
		<th><?php __('Estado de idea'); ?></th>
		<th><?php __('Estado de carta'); ?></th>
		<th><?php __('Estado de proyecto'); ?></th>
		<th><?php __('Observación'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($emsefor['Onereport'] as $onereport):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
			$view_url = $this->webroot.
				'onereports/'.
				'/view/'.$onereport['id'];
		?>
		<tr<?php echo $class;?> onclick="window.location.assign('<?php echo $view_url; ?>');">
			<td><?php echo $onereport['id'];?></td>
			<td><?php echo $engineers[$onereport['engineer_id']]['Engineer']['nombre'];?>
			<td><?php echo $onereport['fecha'];?></td>
			<td><?php echo $onereport['trabajador'];?></td>
			<td><?php echo $indicators[$onereport['indicator_id']];?></td>
			<td><?php echo $onereport['resumen'];?></td>
			<td><?php echo $ideasstates[$onereport['ideasstate_id']];?></td>
			<td><?php echo $cartastates[$onereport['cartastate_id']];?></td>
			<td><?php echo $proyectostates[$onereport['proyectostate_id']];?></td>
			<td><?php echo $onereport['observacion'];?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	
	</div>

</div>
<!--
<div class="emsefors view">
<h2><?php  __('Emsefor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $emsefor['Emsefor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $emsefor['Emsefor']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lugar'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $emsefor['Emsefor']['lugar']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unity Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $emsefor['Emsefor']['unity_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Filial Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $emsefor['Emsefor']['filial_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Emsefor', true), array('action' => 'edit', $emsefor['Emsefor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Emsefor', true), array('action' => 'delete', $emsefor['Emsefor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $emsefor['Emsefor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Emsefors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('controller' => 'filials', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Filial', true), array('controller' => 'filials', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities', true), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity', true), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php __('Related Filials');?></h3>
	<?php if (!empty($emsefor['Filial'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $emsefor['Filial']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $emsefor['Filial']['nombre'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lugar');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $emsefor['Filial']['lugar'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Filial', true), array('controller' => 'filials', 'action' => 'edit', $emsefor['Filial']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php __('Related Unities');?></h3>
	<?php if (!empty($emsefor['Unity'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $emsefor['Unity']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $emsefor['Unity']['nombre'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Descripcion');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $emsefor['Unity']['descripcion'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Unity', true), array('controller' => 'unities', 'action' => 'edit', $emsefor['Unity']['id'])); ?></li>
			</ul>
		</div>
	</div>


	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Tworeports');?></h3>
	<?php if (!empty($emsefor['Tworeport'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Engineer Id'); ?></th>
		<th><?php __('Semana'); ?></th>
		<th><?php __('Fecha'); ?></th>
		<th><?php __('Activity Id'); ?></th>
		<th><?php __('Emsefor Id'); ?></th>
		<th><?php __('Cuadrilla'); ?></th>
		<th><?php __('Unity Id'); ?></th>
		<th><?php __('Contacto'); ?></th>
		<th><?php __('Lugar'); ?></th>
		<th><?php __('State Id'); ?></th>
		<th><?php __('Tema'); ?></th>
		<th><?php __('Parent'); ?></th>
		<th><?php __('Order'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($emsefor['Tworeport'] as $tworeport):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $tworeport['id'];?></td>
			<td><?php echo $tworeport['engineer_id'];?></td>
			<td><?php echo $tworeport['semana'];?></td>
			<td><?php echo $tworeport['fecha'];?></td>
			<td><?php echo $tworeport['activity_id'];?></td>
			<td><?php echo $tworeport['emsefor_id'];?></td>
			<td><?php echo $tworeport['cuadrilla'];?></td>
			<td><?php echo $tworeport['unity_id'];?></td>
			<td><?php echo $tworeport['contacto'];?></td>
			<td><?php echo $tworeport['lugar'];?></td>
			<td><?php echo $tworeport['state_id'];?></td>
			<td><?php echo $tworeport['tema'];?></td>
			<td><?php echo $tworeport['parent'];?></td>
			<td><?php echo $tworeport['order'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'tworeports', 'action' => 'view', $tworeport['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'tworeports', 'action' => 'edit', $tworeport['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'tworeports', 'action' => 'delete', $tworeport['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tworeport['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

-->
