<?php
/**
 * This file is part of OXID Professional Services Password Policy module.
 *
 * OXID Professional Services Password Policy module is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID Professional Services Password Policy module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID Professional Services Password Policy module.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author        OXID Professional services
 * @link          http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2019
 */

/**
 * Password policy main controller
 */
class OxpsPasswordPolicyAccountPassword extends OxpsPasswordPolicyAccountPassword_parent
{

    /**
     * @var object $_oPasswordPolicy Password policy module instance.
     */
    protected $_oPasswordPolicy;


    /**
     * Overridden init method, that creates password policy module object.
     */
    public function init()
    {

        // Parent call
        $this->_oxpsPasswordPolicyAccountPassword_init_parent();

        $this->setPasswordPolicy();
    }


    /**
     * Set Password Policy instance
     *
     * @param mixed $mPasswordPolicy
     */
    public function setPasswordPolicy($oPasswordPolicy = null)
    {
        $this->_oPasswordPolicy = is_object($oPasswordPolicy) ? $oPasswordPolicy : oxNew('OxpsPasswordPolicyModule');
    }

    /**
     * @return object Password policy module instance.
     */
    public function getPasswordPolicy()
    {
        return $this->_oPasswordPolicy;
    }


    /**
     * Overridden password changing form page render method to add password policy parameters.
     *
     * @return string
     */
    public function render()
    {

        // Assign current settings values
        $this->_aViewData = array_merge($this->_aViewData, $this->getPasswordPolicy()->getModuleSettings());

        // Parent call
        return $this->_oxpsPasswordPolicyAccountPassword_render_parent();
    }


    /**
     * Overridden password changing callback method to add password policy validation.
     *
     * @return mixed
     */
    public function changePassword()
    {
        /** @var oxConfig $oConfig */
        $oConfig = $this->getConfig();
        $oModule = $this->getPasswordPolicy();

        // Validate password using password policy rules
        if (is_object($oModule) and $oModule->validatePassword($oConfig->getRequestParameter('password_new'))) {
            return false;
        }

        // Parent call
        return $this->_oxpsPasswordPolicyAccountPassword_changePassword_parent();
    }


    /**
     * Parent `init` call. Method required for mocking.
     *
     * @return mixed
     */
    protected function _oxpsPasswordPolicyAccountPassword_init_parent()
    {
        // @codeCoverageIgnoreStart
        return parent::init();
        // @codeCoverageIgnoreEnd
    }

    /**
     * Parent `render` call. Method required for mocking.
     *
     * @return mixed
     */
    protected function _oxpsPasswordPolicyAccountPassword_render_parent()
    {
        // @codeCoverageIgnoreStart
        return parent::render();
        // @codeCoverageIgnoreEnd
    }

    /**
     * Parent `changePassword` call. Method required for mocking.
     *
     * @return mixed
     */
    protected function _oxpsPasswordPolicyAccountPassword_changePassword_parent()
    {
        // @codeCoverageIgnoreStart
        return parent::changePassword();
        // @codeCoverageIgnoreEnd
    }
}
