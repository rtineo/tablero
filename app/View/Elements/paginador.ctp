<table>
	<tbody>
		<tr>
		<td>
				
		</td>
		
		<td>
			<div class="paging" style="width: 400px">
				<?php echo $this->Paginator->prev('<< '.__('previous', true),$options = array(), null, array('class'=>'disabled'));?>
				<?php //echo $this->Paginator->prev(' << ' . __('previous'), array(), null, array('class' => 'prev disabled'));?>
				|<?php echo $this->Paginator->counter(array('format' => __(' Page %page% of %pages% ')));?>|
				<?php echo $this->Paginator->numbers();?>
				<?php echo $this->Paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
			</div>
		</td>
		
		<td>
			<div class="contador" >
				<?php
					echo $this->Paginator->counter(array(
					'format' => __('View %current% of %count%')
					));
				?>
			</div>	
		</td>
		</tr>
	</tbody>
</table>
