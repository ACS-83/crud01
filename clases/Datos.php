<?php
    namespace Clases;
    require '../vendor/autoload.php';
    use Faker\Factory;
    use Clases\Users;
    class Datos {
        public $faker;
        public function __construct($tabla, $cantidad) {
        // Crea datos ficticios con faker en español
            $this->faker=Factory::create('es_ES');
            switch($tabla) {
                case "users":
                    $this->crearUsuarios($cantidad);
                    break;
            }
        }
        public function crearUsuarios($n) {
            // Creamos un usuario
            $usuario = new Users();
            // Borro todos los anteriores
            $usuario->borrarTodo();
            // INTRODUZCO DATOS DEL ADMINISTRADOR DE FORMA MANUAL
            $usuario->setNombre("Gabriel");
            $usuario->setApellidos("Cifuentes Magallanes");
            $usuario->setUsername("admin");
            $usuario->setMail("admin@mail.com");
            $pass=hash('sha256', "secret0");
            $usuario->setPass($pass);
            $usuario->create();
            // Creamos el resto mediante faker
            for($i=0; $i<$n-1; $i++) {
                $usuario->setNombre($this->faker->firstName());
                // Genera dos apellidos
                $usuario->setApellidos($this->faker->lastName()." ". $this->faker->lastName());
                $usuario->setUsername($this->faker->unique()->userName);
                $usuario->setMail($this->faker->unique()->email);
                $usuario->setPAss($this->faker->sha256);
                $usuario->create();
            }
            $usuario=null;
        }
    }
?>