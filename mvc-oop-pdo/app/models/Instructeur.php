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
        $this->db->query("SELECT instructeur.Id AS INID
                                ,instructeur.Voornaam AS INNA
                                ,instructeur.Tussenvoegsel AS INTU
                                ,instructeur.Achternaam AS INAC
                                ,instructeur.Mobiel AS INMO
                                ,instructeur.DatumInDienst 
                                ,instructeur.Aantalsterren AS INAA
                          FROM instructeur 
                          ORDER BY Instructeur.Aantalsterren DESC
                        ");


        return $this->db->resultSet();
    }

    public function getInstructeurById($Id) 
    {
        $sql = "SELECT  instructeur.Voornaam
                        ,instructeur.Tussenvoegsel
                        ,instructeur.Achternaam
                        ,instructeur.DatumInDienst
                        ,instructeur.AantalSterren
                        FROM instructeur 
                        WHERE Id = :Id;";
        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        $result = $this->db->single();
        return $result;
    }

    public function getGebruikteVoertuigen($Id) 
    {
        $sql = "SELECT   typevoertuig.TypeVoertuig
                        ,typevoertuig.Rijbewijscategorie
                        ,voertuig.Type
                        ,voertuig.Kenteken
                        ,voertuig.Bouwjaar
                        ,voertuig.Brandstof

                FROM    Instructeur
                INNER JOIN voertuiginstructeur
                ON         voertuiginstructeur.InstructeurId = Instructeur.Id
                INNER JOIN Voertuig
                ON         voertuiginstructeur.VoertuigId = voertuig.Id
                INNER JOIN typevoertuig
                ON         voertuig.TypeVoertuigId = typevoertuig.Id
                WHERE   instructeur.Id = :Id
                ORDER BY typevoertuig.Rijbewijscategorie ASC";
        $this->db->query($sql);
        $this->db->bind(':Id', $Id, PDO::PARAM_INT);
        $result = $this->db->resultSet();
        return $result;
    }

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
