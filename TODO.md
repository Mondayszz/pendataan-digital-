# TODO: Change Data Entry to Per KK (Family Card)

## Completed Steps

- [x] Create migration for 'kks' table with fields: no_kk (unique), alamat, kepala_keluarga
- [x] Create migration to add 'kk_id' foreign key to 'penduduks' table
- [x] Create Kk model (app/Models/Kk.php)
- [x] Update Penduduk model to include relationship with Kk
- [x] Create KkController for managing KK creation and listing
- [x] Update PendudukController to handle member addition to KK
- [x] Create KK creation form view (resources/views/kk/create.blade.php)
- [x] Create KK index view (resources/views/kk/index.blade.php)
- [x] Update penduduk create form to select KK
- [x] Update penduduk index view to group by KK instead of jaga
- [x] Update routes to include KK resource routes
- [x] Run migrations to update database
- [x] Update penduduk edit view to include KK selection

## Remaining Steps

- [ ] Create KK show and edit views
- [ ] Update export functionality to include KK data
- [ ] Test full workflow from KK creation to member addition
- [ ] Verify data display and export functionality
- [x] Add status_keluarga field to penduduks table
- [x] Update models, controllers, and views to include status_keluarga
- [x] Run migration for status_keluarga
- [x] Update KK create form to include family member input fields
- [x] Update KkController store method to handle family member creation
