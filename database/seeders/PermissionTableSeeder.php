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


        /*News*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'news',
            ],
            [
                'display_name' => 'Yangiliklar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_news_index',
            ],
            [
                'display_name' => 'Yangiliklar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_news_store',
            ],
            [
                'display_name' => 'Yangillikni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_news_update',
            ],
            [
                'display_name' => 'Yangilikni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_news_show',
            ],
            [
                'display_name' => 'Mamlakatni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_news_destroy',
            ],
            [
                'display_name' => 'Mamlakatni o\'chirish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_news_update_status',
            ],
            [
                'display_name' => 'Yangilikni o\'chirish',
                'parent_id' => $parent->id
            ]);

        /*Remark*/

        $parent = Permission::updateOrCreate(
            [
                'name' => 'remark',
            ],
            [
                'display_name' => 'Remarklar'
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_remark_index',
            ],
            [
                'display_name' => 'Remarklar ro\'yxati',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_remark_store',
            ],
            [
                'display_name' => 'Remarklarni saqlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_remark_update',
            ],
            [
                'display_name' => 'remarklarni tahrirlash',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_remark_show',
            ],
            [
                'display_name' => 'Remarkni ko\'rish',
                'parent_id' => $parent->id
            ]);

        Permission::updateOrCreate(
            [
                'name' => 'crm_remark_destroy',
            ],
            [
                'display_name' => 'Remarkni o\'chirish',
                'parent_id' => $parent->id
            ]);
    }
}
