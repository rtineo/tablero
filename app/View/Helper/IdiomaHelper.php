<?php
class IdiomaHelper extends Helper {
    
    /**
     * Devuelve la etiqueta correspondiente a la clave especificada
     *
     * Invoca a la funcion etiqueta del controlador.
     *
     * @param string $clave
     * @param string $subsistema nombre del subsistema
     * @return string etiqueta
     */
    function etiqueta($clave, $subsistema=null) {
        return $this->view->controller->etiqueta($clave, $subsistema);
    }
    
    /**
     * Devuelve el título correspondiente a la clave especificada
     *
     * Invoca a la funcion título del controlador.
     *
     * @param string $clave
     * @param string $subsistema nombre del subsistema
     * @return string titulo
     */
    function titulo($clave, $subsistema=null) {
        return $this->view->controller->titulo($clave, $subsistema);
    }
    
    /**
     * Devuelve la etiqueta de menu correspondiente a la clave especificada
     *
     * Invoca a la funcion menu del controlador.
     *
     * @param string $clave
     * @param string $subsistema nombre del subsistema
     * @return string titulo
     */
    function menu($clave, $subsistema=null) {
        return $this->view->controller->menu($clave, $subsistema);
    }
    
    /**
     * Devuelve la etiqueta de programa correspondiente a la clave especificada
     *
     * Invoca a la funcion programa del controlador.
     *
     * @param string $clave
     * @param string $subsistema nombre del subsistema
     * @return string titulo
     */
    function programa($clave, $subsistema=null) {
        return $this->view->controller->programa($clave, $subsistema);
    }
    
    /**
     * Devuelve el mensaje correspondiente a la clave especificada
     *
     * Invoca a la funcion mensaje del controlador.
     *
     * @param string $clave
     * @param string $subsistema nombre del subsistema
     * @return string mensaje
     */
    function mensaje($clave, $subsistema=null) {
        return $this->view->controller->mensaje($clave, $subsistema);
    }
    
    /**
     * Devuelve el dato correspondiente a la clave especificada, del arreglo especificado,
	 * en el subsistema establecido.
     *
     * Invoca a la funcion mensaje del controlador.
     *
     * @param string $clave_arreglo clave del arreglo
     * @param string $clave clave del dato
     * @param string $subsistema nombre del subsistema
     * @return string dato
     */
    function dato($clave_arreglo, $clave=null, $subsistema=null) {
        return $this->view->controller->dato($clave_arreglo, $clave, $subsistema);
    }
    
}
?>
