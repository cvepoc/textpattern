<?php

/*
 * Textpattern Content Management System
 * https://textpattern.com/
 *
 * Copyright (C) 2020 The Textpattern Development Team
 *
 * This file is part of Textpattern.
 *
 * Textpattern is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2.
 *
 * Textpattern is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Textpattern. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * An &lt;input /&gt; tag.
 *
 * @since   4.9.0
 * @package UI
 */

namespace Textpattern\UI;

class Input extends Tag implements UIInterface
{
    /**
     * The key (id) used in the tag.
     *
     * @var string
     */

    protected $key = null;

    /**
     * Construct a single text input field.
     *
     * @param string $name  The text input key (HTML name attribute)
     * @param string $type  The HTML type attribute
     * @param string $value The default value to assign
     */

    public function __construct($name, $type = null, $value = null)
    {
        if ($type === null) {
            $type = 'text';
        }

        $this->key = $name;

        parent::__construct('input');
        $this->setAtts(array(
                'name' => $this->key,
                'type' => $type,
            ));

        if ($value !== null) {
            $this->setAtt('value', $value, array('flag' => TEXTPATTERN_STRIP_NONE));
        }
    }

    /**
     * Fetch the key (id) in use by this text input.
     *
     * @return string
     */

    public function getKey()
    {
        return $this->key;
    }

    /**
     * Render the tag.
     *
     * @return string HTML
     */

    public function render($flavour = null)
    {
        if ($this->getAtt('required') && !$this->getAtt('placeholder')
            && in_array($this->getAtt('type'), array('email', 'password', 'search', 'tel', 'text', 'url'))
        ) {
            $this->setAtt('placeholder', gTxt('required'));
        }

        return parent::render($flavour);
    }
}
