<?php

include_once(__DIR__ . '/../ParteAdmin/Clases/class.DataManager.php');


class Login
{


    private $nomUsuario;
    private $passW;
    private $tipoUsuario;
    private $rol;
    private $expiracion;
    private $conexionBD;
    public $mensaje;
    private $usuarioValido;

    public function __construct()
    {
        
        $this->rol = "";
        $this->tipoUsuario = "";
        $this->expiracion = "";
        $this->nomUsuario = "";
        $this->passW = "";
        $this->usuarioValido = NULL;
    }

    public function _getMensaje()
    {
        return $this->mensaje;
    }

    public function _getRol()
    {
        return $this->rol;
    }
    public function _getTipoUsuario()
    {
        return $this->tipoUsuario;
    }
    public function _getExpiracion()
    {
        return $this->expiracion;
    }

    private function _getUsuario()
    {
        return $this->nomUsuario;
    }

    private function _getContra()
    {
        return $this->passW;
    }

    public function _getUsuarioValido(){
        return $this->usuarioValido;
    }


    //setterss
    public function _setMensaje($mensaje)
    {
        return $this->mensaje = $mensaje;
    }
    public function _setRol($rol)
    {
        $this->rol = $rol;
    }

    public function _setTipoUsuario($tipo)
    {
        $this->tipoUsuario = $tipo;
    }
    public function _setExpiracion($fecha)
    {
        $this->expiracion = $fecha;
    }

    //métodos:::
    private function hacerConexion()
    {
        DataManager::iniciaConexion();
        $this->conexionBD = DataManager::_getConexion();
    }

    public function preparaLogin()
    {
        $this->hacerConexion();

        $usuarios = DataManager::_getUsuarios();

        if ($_POST) {

            $this->nomUsuario = $_POST['usuario'];
            $this->passW = $_POST['password'];

            $this->usuarioValido = FALSE;  
            //buscará entre la lista de los usuarios
            foreach ($usuarios as $usuario) {
                if ($usuario['NombreUsuario'] === $this->nomUsuario
                    && $usuario['Password'] === $this->passW) 
                {
                    echo "Tu usuario es $this->nomUsuario";
                    $this->usuarioValido = TRUE;
                    $_SESSION['usuario'] = $usuario['NombreUsuario'];
                    $_SESSION['tipo'] = $usuario['TipoUsuario'];
                    
                    if ($usuario['TipoUsuario'] === 1) {
                        //que vaya al index admin
                        header('Location:ParteAdmin/adminIndex.php');
                    } elseif ($usuario['TipoUsuario'] === 2) {
                        //que vaya al index profesor
                        header('Location:Maestro/maestroIndex.php');
                    }
                    exit;
                }
            }
        }
        if ($this->usuarioValido == FALSE) {
            $this->_setMensaje("Error. Verifica tus datos");
        }
    }
}
