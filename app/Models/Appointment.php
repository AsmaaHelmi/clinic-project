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
    ) {

        $this->patientId       = $patientId;
        $this->doctorId        = $doctorId;
        $this->phone           = $phone;
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

            $this->appointmentTime,

        ]);

        return (bool) $stmt->fetch();
    }

    public static function getBookedTimes(PDO $pdo, int $doctorId, string $appointmentDate): array
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
            $appointmentDate,
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

            'pending',

        ]);

    }

    public static function getPatientAppointments(PDO $pdo, int $patientId)
    {

        $sql = "

    SELECT
        appointments.*,
        users.name AS doctor_name,
        majors.title AS major_title

    FROM appointments

    JOIN doctors
    ON appointments.doctor_id = doctors.id

    JOIN users
    ON doctors.user_id = users.id

    JOIN majors
    ON doctors.major_id = majors.id

    WHERE appointments.patient_id = ?

    ORDER BY appointment_date ASC

    ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$patientId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function getDoctorAppointments(PDO $pdo, int $doctorId)
    {

        $sql = "

    SELECT
        appointments.*,
        users.name AS patient_name

    FROM appointments

    JOIN users
    ON appointments.patient_id = users.id

    WHERE appointments.doctor_id = ?

    ORDER BY appointment_date ASC

    ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$doctorId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function delete(PDO $pdo, int $appointmentId): bool
    {

        $sql = "

    DELETE FROM appointments

    WHERE id = ?

    ";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([$appointmentId]);
    }
}
