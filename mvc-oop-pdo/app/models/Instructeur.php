<?php

/**
 * Dit is de model voor de controller Lessen
 */

class Instructeur
{
    //properties
    private $db;

    // Dit is de constructor van de Country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getInstructeurs()
    {
        $this->db->query("SELECT Id 
                                ,Voornaam 
                                ,Tussenvoegsel 
                                ,Achternaam 
                                ,Mobiel 
                                ,DatumInDienst
                                ,Aantalsterren 
                          FROM instructeur 
                          WHERE instructeur.Id = :Id
                          ORDER BY Instructeur.Aantalsterren DESC
                        ");

        $this->db->bind(':Id', 2, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    // public function getTopics($mankementId)
    // {
    //     // Maak je query
    //     $sql = "SELECT Mankement.Datum
    //                   ,Mankement.Id
    //                   ,Mankement.Mankement
    //             FROM Mankement
    //             INNER JOIN Auto
    //             ON Auto.Id = Mankement.AutoId
    //             WHERE Mankement.Id = :mankementId";

    //     // Prepareer je query
    //     $this->db->query($sql);

    //     // Bind de echte waarde aan de placeholder
    //     $this->db->bind(':mankementId', $mankementId, PDO::PARAM_INT);

    //     // Haal je resultaat op en return deze.
    //     return $this->db->resultSet();
    // }

    // public function addMankement($post)
    // {
    //     $sql = "INSERT INTO mankement (AutoId, Datum, Mankement)
    //             VALUES                (:id, :datum, :mankement);";

    //     $this->db->query($sql);

    //     $this->db->bind(':id', $post['id'], PDO::PARAM_INT);
    //     $this->db->bind(':datum', $post['datum'], PDO::PARAM_STR);
    //     $this->db->bind(':mankement', $post['mankement'], PDO::PARAM_STR);

    //     return $this->db->execute();
    // }
}
