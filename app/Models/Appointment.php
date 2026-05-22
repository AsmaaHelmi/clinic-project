<?php

namespace App\Models;

use PDO;

class Appointment
{
    private int $patientId;
    private int $doctorId;
    private string $phone;
    private string $appointmentDate;
    private string $appointmentTime;

    public function __construct(
        int $patientId,
        int $doctorId,
        string $phone,
        string $appointmentDate,
        string $appointmentTime
    )
    {

        $this->patientId = $patientId;
        $this->doctorId = $doctorId;
        $this->phone = $phone;
        $this->appointmentDate = $appointmentDate;
        $this->appointmentTime = $appointmentTime;

    }

    public function isBooked(PDO $pdo): bool
    {
         $sql = "
            SELECT id
            FROM appointments
            WHERE doctor_id = ?
            AND appointment_date = ?
            AND appointment_time = ?
        ";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([

            $this->doctorId,

            $this->appointmentDate,

            $this->appointmentTime

        ]);

        return (bool) $stmt->fetch();
    }


    public static function getBookedTimes(PDO $pdo,int $doctorId,string $appointmentDate): array
    {
        $sql = "
            SELECT appointment_time
            FROM appointments
            WHERE doctor_id = ?
            AND appointment_date = ?
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $doctorId,
            $appointmentDate
        ]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);

    }
    public function create(PDO $pdo): bool
    {
        $sql = "
            INSERT INTO appointments
            (
                patient_id,
                doctor_id,
                phone,
                appointment_date,
                appointment_time,
                status
            )
            VALUES (?,?,?, ?,?,?)";


        $stmt = $pdo->prepare($sql);

        return $stmt->execute([

            $this->patientId,

            $this->doctorId,

            $this->phone,

            $this->appointmentDate,

            $this->appointmentTime,

            'pending'

        ]);

    }

}