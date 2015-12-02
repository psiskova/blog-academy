<?php

Form::macro('submitWithIcon', function ($name, $value, $buttonClass, $icon, $disabled = false) {
    $disabledValue = $disabled ? 'disabled' : '';

    return '<button type="submit" class="btn ' . $buttonClass . '" value="' . $value . '" name="' . $name . '" ' . $disabledValue . '>
                <span  class="glyphicon ' . $icon . '"></span>
            </button>';
});