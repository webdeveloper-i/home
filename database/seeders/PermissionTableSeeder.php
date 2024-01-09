<?php

namespace Database\Seeders;

use App\Models\Crm\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*configs*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_configs'
            ],
            [
                'display_name' => 'Sozlash ma\'lumotlari',
            ]
        );

        Permission::updateOrCreate(
            [
                'name' => 'crm_config_index',
            ],
            [
                'display_name' => 'Sozlash ma\'lumotlari ro\'yxati',
                'parent_id' => $parent->id
            ]
        );

        Permission::updateOrCreate(
            [
                'name' => 'crm_config_store',
            ],
            [
                'display_name' => 'Sozlash ma\'lumotini saqlash',
                'parent_id' => $parent->id
            ]
        );

        Permission::updateOrCreate(
            [
                'name' => 'crm_config_update',
            ],
            [
                'display_name' => 'Sozlash ma\'lumotini o\'zgartirish',
                'parent_id' => $parent->id
            ]
        );

        Permission::updateOrCreate(
            [
                'name' => 'crm_config_show',
            ],
            [
                'display_name' => 'Sozlash ma\'lumotlar',
                'parent_id' => $parent->id
            ]
        );


        /*i18n_sources*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_i18n_sources',
            ],
            [
                'display_name' => 'Tillar'
            ]
        );

        Permission::updateOrCreate(
            [
                'name' => 'crm_i18n_index',
            ],
            [
                'display_name' => 'Tillar ro\'yxati',
                'parent_id' => $parent->id
            ]
        );

        Permission::updateOrCreate(
            [
                'name' => 'crm_i18n_store',
            ],
            [
                'display_name' => 'Tilni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_i18n_update',
            ],
            [
                'display_name' => 'Tilni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_i18n_show',
            ],
            [
                'display_name' => 'Tilni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_i18n_destroy',
            ],
            [
                'display_name' => 'Tilni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*permission_groups*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_permission_groups',
            ],
            [
                'display_name' => 'Huquqlar',
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_permission_group_index',
            ],
            [
                'display_name' => 'Huquq guruhi',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_permission_group_store',
            ],
            [
                'display_name' => 'Huquq guruhini qo\'shish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_permission_group_update',
            ],
            [
                'display_name' => 'Huquq guruhini tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_permission_group_show',
            ],
            [
                'display_name' => 'Huquq guruhini ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_permission_group_destroy',
            ],
            [
                'display_name' => 'Huquq guruhini o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*admin*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_admin',
            ],
            [
                'display_name' => 'Adminlar ro\'yxati (paginationsiz)',
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_admin_index',
            ],
            [
                'display_name' => 'Adminlar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_admin_store',
            ],
            [
                'display_name' => 'Admin ma\'lumotini qo\'shish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_admin_update',
            ],
            [
                'display_name' => 'Admin ma\'lumotini tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_admin_show',
            ],
            [
                'display_name' => 'Admin ma\'lumotini ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_admin_destroy',
            ],
            [
                'display_name' => 'Admin ma\'lumotini o\'chirish',
                'parent_id' => $parent->id
            ]);


        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_users',
            ],
            [
                'display_name' => 'Admin uchun barcha foydalanuvchilar',
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_users_index',
            ],
            [
                'display_name' => 'Admin uchun barcha foydalanuvchilar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_update_role',
            ],
            [
                'display_name' => 'Foydalanuvchi ma\'lumotini almashtirish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_users_show',
            ],
            [
                'display_name' => 'Foydalanuvchi ma\'lumoti',
                'parent_id' => $parent->id
            ]);


        /*Countries*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'countries',
            ],
            [
                'display_name' => 'Mamlakatlar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_countries_index',
            ],
            [
                'display_name' => 'Mamlakatlar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_countries_store',
            ],
            [
                'display_name' => 'Mamlakatni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_countries_update',
            ],
            [
                'display_name' => 'Mamlakatni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_countries_show',
            ],
            [
                'display_name' => 'Mamlakatni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_countries_destroy',
            ],
            [
                'display_name' => 'Mamlakatni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*Admin Publisher Resource*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_publisher_resource',
            ],
            [
                'display_name' => 'Nashriyot manbalari'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_publisher_resource_index',
            ],
            [
                'display_name' => 'Nashriyot manbalari ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_publisher_resource_store',
            ],
            [
                'display_name' => 'Nashriyot manbalarini saqlash',
                'parent_id' => $parent->id
            ]);


        Permission::updateOrCreate(
            [
                'name' => 'crm_publisher_resource_update',
            ],
            [
                'display_name' => 'Nashriyot manbani tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_publisher_resource_update_landing_position',
            ],
            [
                'display_name' => 'Nashriyot manbalarini ommabopligini o\'zgartirish',
                'parent_id' => $parent->id
            ]);



        Permission::updateOrCreate(
            [
                'name' => 'crm_publisher_resource_show',
            ],
            [
                'display_name' => 'Nashriyot manbani ko\'rish',
                'parent_id' => $parent->id
            ]);

        /*Regions*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_region',
            ],
            [
                'display_name' => 'Viloyatlar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_region_index',
            ],
            [
                'display_name' => 'Viloyatlar',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_region_store',
            ],
            [
                'display_name' => 'Viloyat saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_region_update',
            ],
            [
                'display_name' => 'Viloyatni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_region_show',
            ],
            [
                'display_name' => 'Viloyatni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_region_destroy',
            ],
            [
                'display_name' => 'Viloyatni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*resource categories*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_resource_categories',
            ],
            [
                'display_name' => 'Resurs toifalari'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_categories_index',
            ],
            [
                'display_name' => 'Resurs toifalari ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_categories_store',
            ],
            [
                'display_name' => 'Resurs toifani saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_categories_update',
            ],
            [
                'display_name' => 'Resurs toifani tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_categories_show',
            ],
            [
                'display_name' => 'Resurs toifani ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_categories_destroy',
            ],
            [
                'display_name' => 'Resurs toifani o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*resource fields*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_resource_fields',
            ],
            [
                'display_name' => 'Resurs maydonlari'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_fields_index',
            ],
            [
                'display_name' => 'Resurs maydonlari ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_fields_store',
            ],
            [
                'display_name' => 'Resurs maydonni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_fields_update',
            ],
            [
                'display_name' => 'Resurs maydonni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_fields_show',
            ],
            [
                'display_name' => 'Resurs maydonni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_fields_destroy',
            ],
            [
                'display_name' => 'Resurs maydonni o\'chirish',
                'parent_id' => $parent->id
            ]);


        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_resource_languages',
            ],
            [
                'display_name' => 'Resurs tillar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_languages_index',
            ],
            [
                'display_name' => 'Resurs tillar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_languages_store',
            ],
            [
                'display_name' => 'Resurs tilni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_languages_update',
            ],
            [
                'display_name' => 'Resurs tilni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_languages_show',
            ],
            [
                'display_name' => 'Resurs tilni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_languages_destroy',
            ],
            [
                'display_name' => 'Resurs tilni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*resource types*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_resource_types',
            ],
            [
                'display_name' => 'Resurs turlar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_types_index',
            ],
            [
                'display_name' => 'Resurs turlari ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_types_store',
            ],
            [
                'display_name' => 'Resurs turni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_types_update',
            ],
            [
                'display_name' => 'Resurs turni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_types_show',
            ],
            [
                'display_name' => 'Resurs turni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_types_destroy',
            ],
            [
                'display_name' => 'Resurs turni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*resource modifiers*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_resource_modifiers',
            ],
            [
                'display_name' => 'Resurs ochiqligi maydonlari'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_modifiers_index',
            ],
            [
                'display_name' => 'Resurs ochiqligi ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_modifiers_store',
            ],
            [
                'display_name' => 'Resurs ochiqligini saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_modifiers_update',
            ],
            [
                'display_name' => 'Resurs ochiqligini tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_modifiers_show',
            ],
            [
                'display_name' => 'Resurs ochiqligini ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_modifiers_destroy',
            ],
            [
                'display_name' => 'Resurs ochiqligini o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*Universities*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_universities',
            ],
            [
                'display_name' => 'Universitetlar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_universities_index',
            ],
            [
                'display_name' => 'Universitetlar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_universities_store',
            ],
            [
                'display_name' => 'Universitetni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_universities_update',
            ],
            [
                'display_name' => 'Universitetni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_universities_show',
            ],
            [
                'display_name' => 'Universitetni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_universities_destroy',
            ],
            [
                'display_name' => 'Universitetni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*University types*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_university_types',
            ],
            [
                'display_name' => 'Universitet tiplari'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_university_types_index',
            ],
            [
                'display_name' => 'Universitetlar tiplari ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_university_types_store',
            ],
            [
                'display_name' => 'Universitetni tipini saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_university_types_update',
            ],
            [
                'display_name' => 'Universitetni tipini tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_university_types_show',
            ],
            [
                'display_name' => 'Universitetni tipini ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_university_types_destroy',
            ],
            [
                'display_name' => 'Universitetni tipini o\'chirish',
                'parent_id' => $parent->id
            ]);


        /*Landing position*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_landing_position',
            ],
            [
                'display_name' => 'Ommabolik tartibi'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_landing_position_index',
            ],
            [
                'display_name' => 'Ommaboplik tartibi ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_landing_position_store',
            ],
            [
                'display_name' => 'Ommaboplik tartibini saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_landing_position_update',
            ],
            [
                'display_name' => 'Ommaboplik tartibini tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_landing_position_show',
            ],
            [
                'display_name' => 'Ommaboplik tartibini ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_landing_position_destroy',
            ],
            [
                'display_name' => 'Ommaboplik tartibini o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*journal types*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_journal_types',
            ],
            [
                'display_name' => 'Jurnal tiplari'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_types_index',
            ],
            [
                'display_name' => 'Jurnal tiplari ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_types_store',
            ],
            [
                'display_name' => 'Jurnal tiplari saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_types_update',
            ],
            [
                'display_name' => 'Jurnal tiplarini tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_types_show',
            ],
            [
                'display_name' => 'Jurnal tiplarini ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_types_destroy',
            ],
            [
                'display_name' => 'jurnal tiplarini o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*journals */

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_journal',
            ],
            [
                'display_name' => 'Jurnallar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_index',
            ],
            [
                'display_name' => 'Jurnallar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_store',
            ],
            [
                'display_name' => 'Jurnalni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_update',
            ],
            [
                'display_name' => 'Jurnalni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_show',
            ],
            [
                'display_name' => 'Jurnalni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_journal_destroy',
            ],
            [
                'display_name' => 'jurnalni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*resource intendeds */

        $parent = Permission::updateOrCreate(
            [
                'name' => 'crm_resource_intendeds',
            ],
            [
                'display_name' => 'Resurs kimga tegishliligi'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_intendeds_index',
            ],
            [
                'display_name' => 'Resurs kimga tegishliligi ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_intended_store',
            ],
            [
                'display_name' => 'Resurs kimga tegishliligini saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_intended_update',
            ],
            [
                'display_name' => 'Resurs kimga tegishliligini tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_intended_show',
            ],
            [
                'display_name' => 'Resurs kimga tegishliligini ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_resource_intended_destroy',
            ],
            [
                'display_name' => 'Resurs kimga tegishliligini o\'chirish',
                'parent_id' => $parent->id
            ]);
    }
}
