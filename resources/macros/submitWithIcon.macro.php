<?php

Form::macro('submitWithIcon', function ($name, $value, $buttonClass, $icon) {

    return '<button type="submit" class="btn ' . $buttonClass . '" value="' . $value . '" name="' . $name . '">
                <span  class="glyphicon ' . $icon . '"></span>
            </button>';
});