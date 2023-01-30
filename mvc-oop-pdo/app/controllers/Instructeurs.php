<?php

class Instructeurs extends Controller
{
    private $instructeurModel;

    public function __construct()
    {
        // We maken een object van de model class en stoppen dit in $instructeurModel
        $this->instructeurModel = $this->model('instructeur');
    }

    public function index()
    {
        $result = $this->instructeurModel->getInstructeurs();


        // var_dump($result);

        $rows = "";


        foreach ($result as $instructeurinfo) {
            $dateTimeObj =
                new DateTimeImmutable(
                    $instructeurinfo->DatumInDienst,
                    new DateTimeZone('Europe/Amsterdam')
                );
            // var_dump($dateTimeObj);
            $rows .=  "<tr>
                        <td>{$instructeurinfo->INNA}</td>
                        <td>{$instructeurinfo->INTU}</td>
                        <td>{$instructeurinfo->INAC}</td>
                        <td>{$instructeurinfo->INMO}</td>
                        <td>{$dateTimeObj->format('d-m-Y')}</td>
                        <td>{$instructeurinfo->INAA}</td>
                        <td>
                            <a href='" . URLROOT . "/instructeurs/gebruikteVoertuigen/{$instructeurinfo->INID}'>
                            <img src='" . URLROOT . "/img/b_sbrowse.png' alt='table picture'>
                        </td>
                      </tr>";

                    }


        $data = [
            'title' => 'Instructeurs in dienst',
            'rows' => $rows,
            'aantal' => count($result)

        ];
        $this->view('instructeurs/index', $data);
    }

    public function gebruikteVoertuigen($Id) 
    {
      $instructeur = $this->instructeurModel->getInstructeurById($Id);
  
      $gebruikteVoertuigen = $this->instructeurModel->getGebruikteVoertuigen($Id);
  
      if (sizeOf($gebruikteVoertuigen) == 0 ) {
          $rows = "<tr><td colspan='6'>Er zijn op dit moment nog geen voertuigen toegewezen aan deze instructeur</td></tr>";
          header('Refresh:3; url=' . URLROOT . '/instructeurs/index');
      } else {
          $rows = '';
          foreach ($gebruikteVoertuigen as $value){
          $rows .= "<tr>
                      <td>$value->TypeVoertuig</td>
                      <td>$value->Type</td>
                      <td>$value->Kenteken</td>
                      <td>$value->Bouwjaar</td>
                      <td>$value->Brandstof</td>
                      <td>$value->Rijbewijscategorie</td>
                    </tr>";
          }
      }
      
  
      $data = [
          'title' => 'Door Instructeur gebruikte voertuigen',
          'voornaam' => $instructeur->Voornaam,
          'tussenvoegsel' => $instructeur->Tussenvoegsel,
          'achternaam' => $instructeur->Achternaam,
          'datumInDienst' => $instructeur->DatumInDienst,
          'aantalSterren' => $instructeur->AantalSterren,
          'rows' =>$rows
      ];
  
      $this->view('/instructeurs/gebruikteVoertuigen', $data);
    }
  }

    // public function addMankement()
    // {
    //     $result = $this->mankementModel->getMankementen();


    //     if ($_SERVER['REQUEST_METHOD'] == "POST") {

    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //         if (strlen($_POST['mankement']) < 50) {
    //             $result = $this->mankementModel->addMankement($_POST);
    //             if ($result) {
    //                 echo "<h3>Het nieuwe mankement is toegevoegd</h3>";
    //                 header('Refresh:3; url=' . URLROOT . '/mankementen/index');
    //             } else {
    //                 echo "<h3>de data is niet opgeslagen</h3>";
    //                 header('Refresh:3; url=' . URLROOT . '/mankementen/index');
    //             }
    //         } else {
    //             echo "Het nieuwe mankement is meer dan 50 tekens lang en is niet toegevoegd, probeer het opnieuw";
    //             header('Refresh:3; url=' . URLROOT . '/mankementen/addMankement/' . $result[0]->MAID);
    //         }
    //     } else {

    //         $data = [
    //             'title' => 'Invoeren Mankement',
    //             'autoKenteken' => $result[0]->AUKE,
    //             'id' => $result[0]->MAID,
    //         ];

    //         $this->view('mankementen/addMankement', $data);
    //     }
    // }

