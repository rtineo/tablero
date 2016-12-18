<?php
class BuscadorComponent extends Component
{
	function Buscar($elementos)
	{
		if(empty($elementos))
		{
			$this->Session->setFlash('El array elemento requiere valores');
			return ;
		}
		return $elementos;
	}
}
?>