<?php
declare(strict_types=1);
require_once DOL_DOCUMENT_ROOT . '/core/class/commonobject.class.php';

class ImmoBien extends CommonObject
{
    public $table_element = 'llx_immo_bien';
    public $element = 'immobien';

    public $ref;
    public $label;
    public $fk_soc_proprietaire;
    public $type_bien;
    public $etat;
    public $adresse;
    public $cp;
    public $ville;
    public $pays;
    public $superficie_habitable;
    public $nombre_pieces;
    public $description;
    public $prix_location;
    public $prix_vente;
    public $fk_user_creat;
    public $datec;
    public $tms;
    public $status;

    protected $fields = array(
        'rowid'=>array('type'=>'integer','label'=>'ID','enabled'=>1,'visible'=>-1,'position'=>10,'notnull'=>1),
        'ref'=>array('type'=>'varchar(128)','label'=>'Ref','enabled'=>1,'visible'=>1,'position'=>20,'notnull'=>1,'searchall'=>1),
        'label'=>array('type'=>'varchar(255)','label'=>'Libelle','enabled'=>1,'visible'=>1,'position'=>30,'notnull'=>1,'searchall'=>1),
        'fk_soc_proprietaire'=>array('type'=>'integer:Societe:societe/class/societe.class.php','label'=>'Proprietaire','enabled'=>1,'visible'=>1,'position'=>40),
        'type_bien'=>array('type'=>'varchar(64)','label'=>'Type','enabled'=>1,'visible'=>1,'position'=>50),
        'etat'=>array('type'=>'varchar(32)','label'=>'Etat','enabled'=>1,'visible'=>1,'position'=>60),
        'adresse'=>array('type'=>'varchar(255)','label'=>'Adresse','enabled'=>1,'visible'=>1,'position'=>70),
        'cp'=>array('type'=>'varchar(32)','label'=>'CP','enabled'=>1,'visible'=>1,'position'=>80),
        'ville'=>array('type'=>'varchar(128)','label'=>'Ville','enabled'=>1,'visible'=>1,'position'=>90),
        'pays'=>array('type'=>'varchar(2)','label'=>'Pays','enabled'=>1,'visible'=>-1,'position'=>100),
        'superficie_habitable'=>array('type'=>'decimal(24,8)','label'=>'Surface','enabled'=>1,'visible'=>1,'position'=>130),
        'nombre_pieces'=>array('type'=>'integer','label'=>'Pieces','enabled'=>1,'visible'=>1,'position'=>150),
        'description'=>array('type'=>'text','label'=>'Description','enabled'=>1,'visible'=>1,'position'=>190),
        'prix_location'=>array('type'=>'decimal(24,8)','label'=>'Loyer','enabled'=>1,'visible'=>1,'position'=>210),
        'prix_vente'=>array('type'=>'decimal(24,8)','label'=>'Prix vente','enabled'=>1,'visible'=>1,'position'=>220),
        'fk_user_creat'=>array('type'=>'integer:User:user/class/user.class.php','label'=>'Auteur','enabled'=>1,'visible'=>-2,'position'=>510),
        'datec'=>array('type'=>'datetime','label'=>'DateCreation','enabled'=>1,'visible'=>-2,'position'=>530),
        'tms'=>array('type'=>'timestamp','label'=>'DateModif','enabled'=>1,'visible'=>-2,'position'=>540),
        'status'=>array('type'=>'integer','label'=>'Status','enabled'=>1,'visible'=>1,'position'=>1000,'default'=>0),
    );

    public function __construct(DoliDB $db) { $this->db = $db; }

    public function create(User $user, bool $notrigger = false): int {
        $this->ref = $this->getRefNum();
        return $this->createCommon($user, $notrigger);
    }
    public function fetch(int $id, string $ref = ''): int { return $this->fetchCommon($id, $ref); }
    public function update(User $user, bool $notrigger = false): int { return $this->updateCommon($user, $notrigger); }
    public function delete(User $user, bool $notrigger = false): int { return $this->deleteCommon($user, $notrigger); }

    protected function getRefNum(): string {
        $sql = "SELECT MAX(CAST(SUBSTRING(ref FROM '.*-([0-9]+)$') AS INTEGER)) as maxref FROM " . $this->db->prefix() . $this->table_element;
        $resql = $this->db->query($sql);
        $num = ($resql && ($obj = $this->db->fetch_object($resql))) ? ((int)$obj->maxref + 1) : 1;
        return 'B' . date('Y') . '-' . str_pad((string)$num, 4, '0', STR_PAD_LEFT);
    }
}
