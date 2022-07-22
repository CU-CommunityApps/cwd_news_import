# Research News Importer (migration)
Migrate news content from Chronicle to LASSP.

## misc drush/config commands

```
lando drush cim --partial --source=../config
lando drush cim --partial --source=modules/custom/migrations/cwd_news_import/config/install/

drush migr_cim_resnews
drush migr_cim_normal
lando migr_cim_resnews
lando migr_cim_normal

lando drush mim upgrade_d7_taxonomy_term_policy_executive
lando drush mr upgrade_d7_taxonomy_term_policy_executive
lando drush ms upgrade_d7_taxonomy_term_policy_executive
lando drush mmsg upgrade_d7_taxonomy_term_policy_executive

terminus drush lassp.news -- cim --partial --source=../config
terminus drush lassp.news -- cim --partial --source=modules/custom/migrations/cwd_news_import/config/install
```

## deployment
1. Deploy code (in my case: merge "news" branch into main branch, push to Pantheon ("dev" env).
1. Config import -- or, enable module first then config import......?
```
drush @pantheon.lassp.news en cwd_news_import
drush @pantheon.lassp.news cim
```
1. Run migrations:
```
terminus drush lassp.news -- mim news_chronicle_images_files
terminus drush lassp.news -- mim news_chronicle_images_media
terminus drush lassp.news -- mim news_chronicle_nodes

```
