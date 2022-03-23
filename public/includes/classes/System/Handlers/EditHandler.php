<?php namespace System\Handlers;

use System\Databases\Database;
use System\Form\Data;
use System\Products\Product;
//use System\Utils\Image;

/**
 * Class AddHandler
 * @package System\Handlers
 */
class EditHandler extends BaseHandler
{
    use ProductFillAndValidate;

    private Product $product;

    public function initialize(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: login');
            exit;
        }
        //Init the database
        $db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();

        try {
            //Get the record from the db & execute POST logic
            $this->product = Product::getById($_GET['id'], $db);
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //If image is not empty, process the new image file
//                if ($_FILES['image']['error'] != 4) {
//                    //Init image class
//                    $image = new Image();
//
//                    //Remove old image
//                    $image->delete($this->album->image);
//
//                    //Store new image & retrieve name for database saving (override current image name)
//                    $this->album->image = 'images/' . $image->save($_FILES['image']);
//                }

                //Save the record to the db
                if ($this->product->update($db)) {
                    $success = "Het product is aangepast!";
                } else {
                    //Probably should't be returned to a user..
                    $this->errors[] = "Database error info: " . $db->errorInfo();
                }
            }

            $pageTitle = 'Edit ' . $this->product->name;
        } catch (\Exception $e) {
            //Probably should't be returned to a user..
            $this->errors[] = $e->getMessage();
            $pageTitle = 'Dit product bestaat niet!';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'product' => $this->product ?? false,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }
}