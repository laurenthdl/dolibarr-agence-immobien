<?php
declare(strict_types=1);
require_once __DIR__ . '/../../main.inc.php';
require_once DOL_DOCUMENT_ROOT . '/core/class/html.form.class.php';
require_once DOL_DOCUMENT_ROOT . '/societe/class/societe.class.php';
require_once __DIR__ . '/class/immobien.class.php';

$langs->load("immobien@immobien");
$form = new Form($db);

$action = GETPOST('action', 'aZ09');
$id = GETPOST('id', 'int');
$object = new ImmoBien($db);

if ($action === 'create' && !empty($_POST['label'])) {
    $object->label = GETPOST('label', 'alpha');
    $object->type_bien = GETPOST('type_bien', 'alpha');
    $object->etat = GETPOST('etat', 'alpha');
    $object->adresse = GETPOST('adresse', 'alpha');
    $object->cp = GETPOST('cp', 'alpha');
    $object->ville = GETPOST('ville', 'alpha');
    $object->superficie_habitable = GETPOST('superficie_habitable', 'alpha');
    $object->nombre_pieces = GETPOST('nombre_pieces', 'int');
    $object->description = GETPOST('description', 'none');
    $object->prix_location = GETPOST('prix_location', 'alpha');
    $object->prix_vente = GETPOST('prix_vente', 'alpha');
    $object->fk_soc_proprietaire = GETPOST('fk_soc_proprietaire', 'int');
    $object->status = 1;
    $res = $object->create($user);
    if ($res > 0) { setEventMessages('Bien cree : ' . $object->ref, null, 'mesgs'); header("Location: card.php?id=" . $object->rowid); exit; }
    else { setEventMessages($object->error, null, 'errors'); }
}

if ($action === 'update' && $id > 0) {
    if ($object->fetch($id) > 0) {
        $object->label = GETPOST('label', 'alpha');
        $object->type_bien = GETPOST('type_bien', 'alpha');
        $object->etat = GETPOST('etat', 'alpha');
        $object->adresse = GETPOST('adresse', 'alpha');
        $object->ville = GETPOST('ville', 'alpha');
        $object->superficie_habitable = GETPOST('superficie_habitable', 'alpha');
        $object->nombre_pieces = GETPOST('nombre_pieces', 'int');
        $object->description = GETPOST('description', 'none');
        $object->prix_location = GETPOST('prix_location', 'alpha');
        $object->prix_vente = GETPOST('prix_vente', 'alpha');
        $object->fk_soc_proprietaire = GETPOST('fk_soc_proprietaire', 'int');
        $res = $object->update($user);
        if ($res > 0) { setEventMessages('Modifications enregistrees', null, 'mesgs'); header("Location: card.php?id=" . $id); exit; }
    }
}

if ($id > 0) $object->fetch($id);

$title = ($action === 'create') ? 'Nouveau bien' : (($action === 'edit') ? 'Modifier bien' : 'Fiche bien');
llxHeader('', $title);
print load_fiche_titre($title, '', 'company.png');

if ($action === 'create' || $action === 'edit') {
    print '<form method="POST" action="' . $_SERVER["PHP_SELF"] . '">';
    print '<input type="hidden" name="token" value="' . newToken() . '">';
    if ($action === 'edit') print '<input type="hidden" name="id" value="' . $id . '">';
    print '<input type="hidden" name="action" value="' . ($action === 'create' ? 'create' : 'update') . '">';
    print '<table class="border centpercent">';
    print '<tr><td class="fieldrequired">Libelle</td><td><input name="label" value="' . dol_escape_htmltag($object->label ?? '') . '" class="minwidth300"></td></tr>';
    print '<tr><td>Type</td><td><input name="type_bien" value="' . dol_escape_htmltag($object->type_bien ?? '') . '" placeholder="Maison, Appartement..."></td></tr>';
    print '<tr><td>Etat</td><td><select name="etat"><option value="DISPONIBLE"' . (($object->etat??'')=='DISPONIBLE'?' selected':'') . '>Disponible</option><option value="A_LOUER"' . (($object->etat??'')=='A_LOUER'?' selected':'') . '>A louer</option><option value="A_VENDRE"' . (($object->etat??'')=='A_VENDRE'?' selected':'') . '>A vendre</option><option value="LOUE"' . (($object->etat??'')=='LOUE'?' selected':'') . '>Loue</option><option value="VENDU"' . (($object->etat??'')=='VENDU'?' selected':'') . '>Vendu</option></select></td></tr>';
    print '<tr><td>Adresse</td><td><input name="adresse" value="' . dol_escape_htmltag($object->adresse ?? '') . '" class="minwidth300"></td></tr>';
    print '<tr><td>Ville</td><td><input name="ville" value="' . dol_escape_htmltag($object->ville ?? '') . '"></td></tr>';
    print '<tr><td>Surface habitable (m2)</td><td><input name="superficie_habitable" value="' . ($object->superficie_habitable ?? '') . '"></td></tr>';
    print '<tr><td>Nb pieces</td><td><input name="nombre_pieces" value="' . ($object->nombre_pieces ?? '') . '"></td></tr>';
    print '<tr><td>Proprietaire</td><td>' . $form->select_company($object->fk_soc_proprietaire ?? '', 'fk_soc_proprietaire', '1', 0, 1, 0, []) . '</td></tr>';
    print '<tr><td>Prix location (FCFA)</td><td><input name="prix_location" value="' . ($object->prix_location ?? '') . '"></td></tr>';
    print '<tr><td>Prix vente (FCFA)</td><td><input name="prix_vente" value="' . ($object->prix_vente ?? '') . '"></td></tr>';
    print '<tr><td>Description</td><td><textarea name="description" rows="3" class="quatrevingtpercent">' . dol_escape_htmltag($object->description ?? '') . '</textarea></td></tr>';
    print '</table>';
    print '<div class="center"><input type="submit" class="button" value="Enregistrer"> <a class="butActionDelete" href="index.php">Annuler</a></div>';
    print '</form>';
} else {
    print '<table class="border centpercent">';
    print '<tr><td class="titlefield">Ref</td><td>' . dol_escape_htmltag($object->ref) . '</td></tr>';
    print '<tr><td>Libelle</td><td>' . dol_escape_htmltag($object->label) . '</td></tr>';
    print '<tr><td>Type</td><td>' . dol_escape_htmltag($object->type_bien) . '</td></tr>';
    print '<tr><td>Etat</td><td>' . dol_escape_htmltag($object->etat) . '</td></tr>';
    print '<tr><td>Adresse</td><td>' . dol_escape_htmltag($object->adresse) . ' - ' . dol_escape_htmltag($object->ville) . '</td></tr>';
    print '<tr><td>Surface</td><td>' . price($object->superficie_habitable) . ' m<sup>2</sup></td></tr>';
    print '<tr><td>Prix location</td><td>' . price($object->prix_location) . ' FCFA</td></tr>';
    print '<tr><td>Prix vente</td><td>' . price($object->prix_vente) . ' FCFA</td></tr>';
    print '<tr><td>Description</td><td>' . nl2br(dol_escape_htmltag($object->description)) . '</td></tr>';
    print '</table>';
    print '<div class="tabsAction">';
    print '<a class="butAction" href="card.php?action=edit&id=' . $id . '">Modifier</a>';
    print '<a class="butAction" href="index.php">Retour liste</a>';
    print '</div>';
}
llxFooter();
