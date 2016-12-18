<table class="calendarioMes" border="0" cellpadding="0" cellspacing="0" align="center">
<thead>
    <tr>
    <?php
    foreach($calendarioMes['dias'] as $numeroDia=>$dia) {
        ?>
        <th class="<?php echo $dia['tipo']?>">
            <?php echo $dia['nombre']?>
        </th>
        <?php
    }
    ?>
    </tr>
</thead>
<tbody>
    <?php
    foreach($calendarioMes['semanas'] as $semana) {
        ?>
        <tr>
        <?php
        foreach($semana as $dia) {
            ?>
            <td class="<?php echo $dia['tipo']?>">
                <?php
				switch ($dia['tipo']) {
					case 'normal':
					case 'feriado':
					case 'actual':
						echo $this->Html->link($dia['etiqueta'], 
						'javascript:;',
						array(
							'onclick'=>'mostrarDia('.$dia['fecha']['anio'].','
								.$dia['fecha']['mes'].','
								.$dia['fecha']['dia'].')'
						));
						break;
					case 'inactivo':
						echo $dia['etiqueta'];
						break;
					case 'vacio':
						break;
				}
                ?>
				&nbsp;
            </td>
            <?php
        }
        ?>
        </tr>
        <?php
    }
    ?>
</tbody>
</table>