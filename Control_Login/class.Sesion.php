<?php
include("../Control_Login/class.Login.php");


class Sesion
{
    private $inactividad_max = 300; //5 minutos
    private $inactivo;
    private $ultimaActividad;

    public function _getInactividad()
    {
        return $this->inactividad_max;
    }
    public function _getUltimaActividad()
    {
        return $this->ultimaActividad;
    }

    public function _setInactividad($tiempo)
    {
        $this->inactividad_max = $tiempo;
    }
    public function _setUltimaActividad()
    {
        $_SESSION['ultima_actividad'] = time();
    }

    public function empiezaSesion()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->_setUltimaActividad();
        //$this->controlaInactividad();
    }

    public function controlaInactividad()
    {
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['tipo'])) {
            header("Location: ../index.php");
        }
        $this->inactivo = time() - $_SESSION['ultima_actividad'];
        if ($this->inactivo > $this->inactividad_max) {
            session_unset();
            session_destroy();
            header("Location: ../index.php?mensaje=sesion_expirada");
            exit;
        }
    }

    public function setSesionAdmin(){

    }
}
