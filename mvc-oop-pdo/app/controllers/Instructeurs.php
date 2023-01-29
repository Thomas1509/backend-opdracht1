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
                      </tr>";
        }


        $data = [
            'title' => 'Instructeurs in dienst',
            'rows' => $rows,
        ];
        $this->view('instructeurs/index', $data);
    }

    // public function topicmankementen($id = NULL)
    // {
    //     // Roep de modelmethod getTopics aan
    //     $result = $this->mankementModel->getTopics($id);

    //     if ($result) {
    //         $dt = new DateTimeImmutable($result[0]->Datum, new DateTimeZone('Europe/Amsterdam'));
    //         $date = $dt->format('d-m-Y');
    //         $time = $dt->format('H:i');
    //     } else {
    //         $date = "";
    //         $time = "";
    //     }

    //     $rows = "";

    //     foreach ($result as $topic) {

    //         $rows .= "<tr>
    //                     <td>{$topic->Mankement}</td>
    //                   </tr>";
    //     }


    //     $data = [
    //         'title' => 'Onderwerpen mankement',
    //         'rows' => $rows,
    //         'date' => $date,
    //         'time' => $time,
    //         'mankementenId' => $id
    //     ];
    //     $this->view('mankementen/index', $data);
    // }

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
}
