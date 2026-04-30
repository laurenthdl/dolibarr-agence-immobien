<?php
declare(strict_types=1);
require_once __DIR__ . '/../../main.inc.php';
require_once DOL_DOCUMENT_ROOT . '/core/class/html.form.class.php';
require_once __DIR__ . '/class/immobien.class.php';

$langs->load("immobien@immobien");
$action = GETPOST('action', 'aZ09');
$id = GETPOST('id', 'int');

if ($action === 'delete' && $id > 0) {
    $object = new ImmoBien($db);
    if ($object->fetch($id) > 0) { $object->delete($user); setEventMessages('Bien supprime', null, 'mesgs'); }
    header("Location: " . $_SERVER["PHP_SELF"]); exit;
}

llxHeader('', 'Biens immobiliers');
print load_fiche_titre('Biens immobiliers', '', 'company.png');
print '<div class="tabsAction"><a class="butAction" href="card.php?action=create">Nouveau bien</a></div><br>';

$sql = "SELECT rowid, ref, label, type_bien, etat, ville, superficie_habitable, prix_location, prix_vente FROM " . $db->prefix() . "immo_bien ORDER BY datec DESC";
$resql = $db->query($sql);

print '<table class="noborder centpercent liste">';
print '<tr class="liste_titre"><th>Ref</th><th>Libelle</th><th>Type</th><th>Etat</th><th>Ville</th><th class="right">Surface</th><th class="right">Location</th><th class="right">Vente</th><th class="center">Actions</th></tr>';

if ($resql) {
    while ($obj = $db->fetch_object($resql)) {
        print '<tr class="oddeven">';
        print '<td><a href="card.php?id=' . $obj->rowid . '">' . $obj->ref . '</a></td>';
        print '<td>' . dol_escape_htmltag($obj->label) . '</td>';
        print '<td>' . dol_escape_htmltag($obj->type_bien) . '</td>';
        print '<td>' . dol_escape_htmltag($obj->etat) . '</td>';
        print '<td>' . dol_escape_htmltag($obj->ville) . '</td>';
        print '<td class="right">' . price($obj->superficie_habitable) . ' m<sup>2</sup></td>';
        print '<td class="right">' . price($obj->prix_location) . '</td>';
        print '<td class="right">' . price($obj->prix_vente) . '</td>';
        print '<td class="center">';
        print '<a href="card.php?action=edit&id=' . $obj->rowid . '">' . img_edit() . '</a> ';
        print '<a href="' . $_SERVER["PHP_SELF"] . '?action=delete&id=' . $obj->rowid . '&token=' . newToken() . '" onclick="return confirm(\'Supprimer ce bien ?\')">' . img_delete() . '</a>';
        print '</td></tr>';
    }
}
print '</table>';
llxFooter();
