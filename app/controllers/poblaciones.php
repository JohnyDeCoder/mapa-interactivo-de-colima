<?php

namespace Controllers;

use Models\Poblacion;

class Poblaciones
{
    // public static function get_AGEB_POBTOT($ageb)
    // {
    //     return Poblacion::where('AGEB', $ageb)->first()->POBTOT;
    // }

    /**
     * AGEBS Getters
     * Áreas Geoestadísticas Básicas
     */

    public static function get_all_onlyAGEB_ALL()
    {
        $agebs = Poblacion::select('AGEB', 'POBTOT', 'POBFEM', 'POBMAS', 'P_0A2', 'P_0A2_F', 'P_0A2_M', 'P_3YMAS', 'P_3YMAS_F', 'P_3YMAS_M', 'P_5YMAS', 'P_5YMAS_F', 'P_5YMAS_M', 'P_12YMAS', 'P_12YMAS_F', 'P_12YMAS_M', 'P_15YMAS', 'P_15YMAS_F', 'P_15YMAS_M', 'P_18YMAS', 'P_18YMAS_F', 'P_18YMAS_M', 'P_3A5', 'P_3A5_F', 'P_3A5_M', 'P_6A11', 'P_6A11_F', 'P_6A11_M', 'P_8A14', 'P_8A14_F', 'P_8A14_M', 'P_12A14', 'P_12A14_F', 'P_12A14_M', 'P_15A17', 'P_15A17_F', 'P_15A17_M', 'P_18A24', 'P_18A24_F', 'P_18A24_M', 'P_15A49_F', 'P_60YMAS', 'P_60YMAS_F', 'P_60YMAS_M', 'REL_H_M', 'POB0_14', 'POB15_64', 'POB65_MAS')
            ->where('MZA', '000')
            ->get()
            ->keyBy('AGEB') // keyBy() crea un array asociativo con la columna AGEBS como llave
            ->toArray();

        return $agebs;
    }


    public static function get_all_onlyAGEB_POBTOT()
    {
        // return Poblacion::select('AGEB', 'POBTOT')->where('MZA', '000')->get()->toArray();
        $agebs = Poblacion::select('AGEB', 'POBTOT')->where('MZA', '000')->get();
        return $agebs->pluck('POBTOT', 'AGEB')->toArray();
    }

    public static function get_all_onlyAGEB_POBFEM()
    {
        $agebs = Poblacion::select('AGEB', 'POBFEM')->where('MZA', '000')->get();
        return $agebs->pluck('POBFEM', 'AGEB')->toArray();
    }

    /**
     * MZA Getters
     * Manzanas
     */

    public static function get_all_MZA_AGEB_POBTOT($ageb)
    {
        return Poblacion::where('AGEB', $ageb)->select('MZA', 'POBTOT')->get()->toArray();
    }
}