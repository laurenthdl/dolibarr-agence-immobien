<?php

declare(strict_types=1);

require_once DOL_DOCUMENT_ROOT . '/core/modules/DolibarrModules.class.php';

class modImmobien extends DolibarrModules
{
    public function __construct($db)
    {
        global $langs, $conf;
        $this->db = $db;
        $this->numero = 700001;
        $this->rights_class = 'immobien';
        $this->family = "other";
        $this->module_position = '90';
        $this->name = preg_replace('/^mod/i', '', get_class($this));
        $this->description = "Gestion des biens immobiliers";
        $this->version = '1.0.0';
        $this->const_name = 'MAIN_MODULE_' . strtoupper($this->name);
        $this->picto = 'company';
        $this->module_parts = array();
        $this->dirs = array();
        $this->config_page_url = array("");
        $this->depends = array('mod_immocore' => 1, 'mod_societe' => 1, 'mod_immoclient' => 1);
        $this->requiredby = array();
        $this->conflictwith = array();
        $this->langfiles = array("immobien");
        $this->phpmin = array(8, 1);
        $this->need_dolibarr_version = array(23, 0);
        $this->warnings_activation = array();
        $this->warnings_activation_ext = array();

        $this->const = array();
        $this->tabs = array();
        $this->dictionaries = array();

        $this->menu = array();
        $r = 0;
        $this->menu[$r] = array(
            'fk_menu' => 'fk_mainmenu=immobilier',
            'type' => 'left',
            'titre' => 'Biens',
            'mainmenu' => 'immobilier',
            'leftmenu' => 'immobien',
            'url' => '/custom/immobien/index.php',
            'langs' => 'immobien',
            'position' => 700001,
            'perms' => '1',
            'target' => '',
            'user' => 2,
        );
        $r++;
        $this->menu[$r] = array(
            'fk_menu' => 'fk_mainmenu=immobilier,fk_leftmenu=immobien',
            'type' => 'left',
            'titre' => 'Nouveau bien',
            'mainmenu' => 'immobilier',
            'leftmenu' => 'immobien',
            'url' => '/custom/immobien/card.php?action=create',
            'langs' => 'immobien',
            'position' => 700002,
            'perms' => '$user->rights->immobien->write',
            'target' => '',
            'user' => 2,
        );
        $r++;
        $this->menu[$r] = array(
            'fk_menu' => 'fk_mainmenu=immobilier,fk_leftmenu=immobien',
            'type' => 'left',
            'titre' => 'Liste des biens',
            'mainmenu' => 'immobilier',
            'leftmenu' => 'immobien',
            'url' => '/custom/immobien/index.php',
            'langs' => 'immobien',
            'position' => 700003,
            'perms' => '$user->rights->immobien->read',
            'target' => '',
            'user' => 2,
        );
        $r++;

        $this->rights = array();
        $this->rights_class = 'immobien';
        $r = 0;
        $this->rights[$r][0] = 700001001;
        $this->rights[$r][1] = 'Lire les biens immobiliers';
        $this->rights[$r][3] = 0;
        $this->rights[$r][4] = 'read';
        $r++;
        $this->rights[$r][0] = 700001002;
        $this->rights[$r][1] = 'Créer/Modifier les biens immobiliers';
        $this->rights[$r][3] = 0;
        $this->rights[$r][4] = 'write';
        $r++;
        $this->rights[$r][0] = 700001003;
        $this->rights[$r][1] = 'Supprimer les biens immobiliers';
        $this->rights[$r][3] = 0;
        $this->rights[$r][4] = 'delete';
    }

    public function init($options = ''): int
    {
        $sql = array();
        return $this->_init($sql, $options);
    }

    public function remove($options = ''): int
    {
        $sql = array();
        return $this->_remove($sql, $options);
    }
}
