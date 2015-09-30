<?php

/**
 * Description of Formbuilder
 *
 * @author Fernando
 */
class Formbuilder {

    private $idprefix;
    private $formDatabase;
    private $validated;

    public function __construct($formDatabase, $idprefix = "") {
        foreach ($formDatabase as $key => &$value) {
            $createdType = $this->getFieldFilter($value);
            if (!array_key_exists('formatter', $value))
                $value['formatter'] = $createdType[2] != NULL ? $createdType[2] : FILTER_UNSAFE_RAW;
            if (!array_key_exists('filter', $value))
                $value['filter'] = $createdType[0] != NULL ? $createdType[0] : FILTER_UNSAFE_RAW;
            if (!array_key_exists('options', $value))
                $value['options'] = $createdType[1] != NULL ? $createdType[1] : [];
            if (!array_key_exists('ignoreEmpty', $value))
                $value['ignoreEmpty'] = false;
            if (!array_key_exists('required', $value))
                $value['required'] = false;
        }
        $this->formDatabase = $formDatabase;
        $this->idprefix = $idprefix;
    }

    private function getFieldFilter(&$type) {
        switch ($type['type']) {
            case "text":
                return [FILTER_UNSAFE_RAW, NULL, FILTER_SANITIZE_STRING];
            case 'number':
                return [FILTER_VALIDATE_INT, NULL, FILTER_SANITIZE_STRING];
            case 'date':
                return [FILTER_CALLBACK, ['options' => function($s) {
                            return $this->filter_validate_date($s);
                        }], FILTER_SANITIZE_STRING];
            case 'token':
                $type['type'] = "hidden";
                return [FILTER_CALLBACK, ['options' => function($s) use ($type) {
                            return $type['token'] == $s ? $s : false;
                        }], FILTER_SANITIZE_STRING];
            case 'time':
                return [FILTER_CALLBACK, ['options' => function($s) {
                            return $this->filter_validate_time($s);
                        }], FILTER_SANITIZE_STRING];
            case 'email':
                return [FILTER_VALIDATE_EMAIL, NULL, FILTER_SANITIZE_EMAIL];
            case 'url':
                return [FILTER_VALIDATE_URL, NULL, FILTER_SANITIZE_URL];
        }
        return [NULL, NULL, NULL];
    }

    public function validateForm() {
        $returnData = ['error' => [], 'values' => []];

        foreach ($this->formDatabase as $key => $value) {
            if (array_key_exists('select', $value)) {
                $select = $value['select'];
                $data = filter_input(INPUT_POST, $key, FILTER_SANITIZE_STRING);
                if ($data === NULL) {
                    $returnData['values'][$key] = NULL;
                    $returnData['error'][$key] = "Dit vak is verplicht";
                } else if (array_key_exists($data, $select)) {
                    $returnData['values'][$key] = $data;
                } else {
                    $returnData['values'][$key] = FALSE;
                    $returnData['error'][$key] = "Ongeldige invoer";
                }
                continue;
            }
            $options = $value['options'];
            $data = filter_input(INPUT_POST, $key, $value['filter'], $options);
            if ($data === false) {
                $returnData['error'][$key] = "Ongeldige invoer";
            } else if ($data === null && $value['required']) {
                $returnData['error'][$key] = "Dit vak is verplicht";
            } else if (is_string($data) && count($data) == 0 && $value['required']) {
                $returnData['error'][$key] = "Dit vak is verplicht";
            }
            if( $data !== null) {
                $returnData['values'][$key] = filter_var($data, $value['formatter'], $options);
            } else {
                $returnData['values'][$key] = NULL;
            }
        }
        $this->validated = $returnData;
        return $returnData;
    }

    public function buildFormControls() {
        $data = [];
        $validated = $this->validated;
        if ($validated === NULL)
            $validated = validateForm($this->formDatabase);
        foreach ($this->formDatabase as $key => $value) {
            $filtered = $validated['values'][$key];
            $error = "";
            if (array_key_exists($key, $validated['error']) &&
                    !($filtered === NULL && $value['ignoreEmpty'])) {
                $error = $validated['error'][$key];
            }
            if ($filtered !== FALSE && $filtered !== NULL)
                $filtered = htmlentities($filtered);
            else
                $filtered = "";
            if($value["type"] != 'hidden')
                $data[$key] = <<<FORM
<label for='$this->idprefix$key'>
    <span class=label>$value[label]</span>
    <span class=error>$error</span>
</label>
FORM;
            else 
                $data[$key] = "";
            if (array_key_exists('select', $value)) {
                $data[$key] .= "<select id='$this->idprefix$key' name='$key' $html>";
                foreach ($value['select'] as $key1 => $value1) {
                    $value1 = htmlentities($value1, ENT_QUOTES);
                    $key1 = htmlentities($key1, ENT_QUOTES);
                    $data[$key] .= "<option value='$key1'" . (strcmp($key1, $filtered) ? " selected" : "") . ">$value1</option>";
                }
                $data[$key] .= "</select>";
            } else {
                if($value["type"] === 'hidden'){
                    $filtered = $value['token'];
                }
                $data[$key] .= "<input type='$value[type]' id='$this->idprefix$key' name='$key' value='$filtered'";
                if(isset($value['placeholder']))
                    $data[$key] .= " placeholder='" . htmlentities($value['placeholder'], ENT_QUOTES) . "'";
                if(isset($value['min']))
                    $data[$key] .= " min='" . htmlentities($value['min'], ENT_QUOTES) . "'";
                if(isset($value['max']))
                    $data[$key] .= " max='" . htmlentities($value['max'], ENT_QUOTES) . "'";
                if(isset($value['step']))
                    $data[$key] .= " step='" . htmlentities($value['step'], ENT_QUOTES) . "'";
                if(isset($value['required']))
                    $data[$key] .= " required";
                if(isset($value['html']))
                    $data[$key] .= " $value[html]";
                $data[$key] .= ">";
            }
        }
        return $data;
    }

    private static function filter_validate_date($date) {
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        $errors = DateTime::getLastErrors();
        if (!empty($errors['warning_count'])) {
            return false;
        }
        return $dateTime !== false ? $date : false;
    }

    private static function filter_validate_time($date) {
        $dateTime = DateTime::createFromFormat('H:i', $date);
        $errors = DateTime::getLastErrors();
        if (!empty($errors['warning_count'])) {
            return false;
        }
        return $dateTime !== false ? $date : false;
    }

    private static function filter_validate_non_empty_string($value) {
        if (!is_string($value)) {
            return false;
        } else if (empty($value)) {
            return false;
        }
        return $value;
    }
    
    public function isFilledIn() {
        if($this->validated == null) {
            $this->validateForm();
        }
        return empty($this->validated['error']);
    }
    
    public function getValues() {
        if($this->validated == null) {
            $this->validateForm();
        }
        if(!empty($this->validated['error'])) {
            throw new RuntimeException("Form contains errors, call isFilledIn() first");
        }
        return $this->validated['values'];
    }

}
