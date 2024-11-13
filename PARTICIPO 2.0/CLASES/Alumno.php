<?php

class Alumno {
    private $conexion;
    private $nombre;
    private $apellido;
    private $email;
    private $fechaNacimiento;
    private $dni;

    public function __construct($conexion, $nombre, $apellido, $email = null, $fechaNacimiento = null, $dni = null) {
        $this->conexion = $conexion;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->dni = $dni;
    }

    public function insertarAlumno() {
        // Inserta al alumno en la tabla 'alumnos' y devuelve el ID insertado.
        $query = $this->conexion->prepare("INSERT INTO alumnos (nombre, apellido, email, fechaNacimiento, dni) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("sssss", $this->nombre, $this->apellido, $this->email, $this->fechaNacimiento, $this->dni);
        
        if ($query->execute()) {
            return $this->conexion->insert_id;
        } else {
            throw new Exception("Error al insertar alumno: " . $query->error);
        }
    }

    public function asociarMateria($idAlumno, $numeroMateria) {
        // Inserta en la tabla 'alumno_materia' para vincular el alumno con la materia seleccionada.
        $query = $this->conexion->prepare("INSERT INTO alumno_materia (idAlumno, numeroMateria) VALUES (?, ?)");
        $query->bind_param("ii", $idAlumno, $numeroMateria);

        if (!$query->execute()) {
            throw new Exception("Error al asociar materia: " . $query->error);
        }
    }
}
