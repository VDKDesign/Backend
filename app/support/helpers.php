<?php

function secondsToTime($seconds)
{
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$seconds");


    if($dtF->diff($dtT)->format('%a') == 0 && $dtF->diff($dtT)->format('%h') == 0)
    {
        if($dtF->diff($dtT)->format('%i') == 1)
        {
            return $dtF->diff($dtT)->format('%i minuut, %s seconden');
        }
        else{
            return $dtF->diff($dtT)->format('%i minuten, %s seconden');
        }
    }
    if($dtF->diff($dtT)->format('%a') == 0 && $dtF->diff($dtT)->format('%h') != 0)
    {
        if($dtF->diff($dtT)->format('%h') == 1 || $dtF->diff($dtT)->format('%h') == 0)
        {
            return $dtF->diff($dtT)->format('%h uur, %i minuten');
        }
        else{
            return $dtF->diff($dtT)->format('%h uren, %i minuten');
        }
    }
    else{
        if($dtF->diff($dtT)->format('%a') == 1)
        {
            return $dtF->diff($dtT)->format('%a dag, %h uren, %i minuten');
        }
        else{
            return $dtF->diff($dtT)->format('%a dagen, %h uren, %i minuten');
        }
    }
}

//GET ID OF ITEM DEPENDS ON ID
function getItem($id)
{
    $menu_items = \App\Models\MenuItem::find($id);
    return $menu_items;
}
//GET SLUG OF ITEM DEPENDS ON ID
function getItemSlug($id)
{
    $menu_items = \App\Models\MenuItem::find($id);
    return $menu_items->slug;
}
//GET TITLE OF ITEM DEPENDS ON ID
function getItemTitle($id)
{
    $menu_items = \App\Models\MenuItem::find($id);
    return $menu_items->title;
}

//GET ID OF SUBITEM DEPENDS ON ID
function getSubItem($id)
{
    $menu_items = \App\Models\MenuSubItem::find($id);
    return $menu_items;
}
//GET SLUG OF SUBITEM DEPENDS ON ID
function getSubItemSlug($id)
{
    $menu_sub_items = \App\Models\MenuSubItem::find($id);
    return $menu_sub_items->slug;
}
//GET TITLE OF SUBITEM DEPENDS ON ID
function getSubItemTitle($id)
{
    $menu_sub_items = \App\Models\MenuSubItem::find($id);
    return $menu_sub_items->title;
}
function getSubItemMenuId($id)
{
    $menu_sub_items = \App\Models\MenuSubItem::find($id);
    return $menu_sub_items->menu_item_id;
}
//GET ID OF SUBITEM DEPENDS ON ID
function getSubSubItem($id)
{
    $menu_sub_sub_items = \App\Models\MenuSubSubItem::find($id);
    return $menu_sub_sub_items;
}
//GET SLUG OF SUBITEM DEPENDS ON ID
function getSubSubItemSlug($id)
{
    $menu_sub_sub_items = \App\Models\MenuSubSubItem::find($id);
    return $menu_sub_sub_items->slug;
}
//GET TITLE OF SUBITEM DEPENDS ON ID
function getSubSubItemTitle($id)
{
    $menu_sub_sub_items = \App\Models\MenuSubSubItem::find($id);
    return $menu_sub_sub_items->title;
}
function getSubSubItemMenuId($id)
{
    $menu_sub_sub_items = \App\Models\MenuSubSubItem::find($id);
    return $menu_sub_sub_items->menu_item_id;
}
