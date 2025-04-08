<?php
    class EmailValidator implements IValidator {
        private $email;

        public function __construct($email) {
            $this->email = $email;
        }

        public function validate(): bool {
            // Validar el correo electrónico con filter_var
            return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
        }
    }
?>
