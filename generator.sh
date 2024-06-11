#!/bin/bash

# Set script directory variable
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"
# Load .env variables
source $SCRIPT_DIR/.env

# Generate list for databases

# Reset file
echo > $SCRIPT_DIR/output/$OUTPUT_DB_FILE
mysql --user="$DB_USER" --password="$DB_PASSWORD" --skip-column-names --execute="SELECT table_schema \"database\", sum(data_length + index_length)/1024/1024 \"size in MB\" FROM information_schema.TABLES GROUP BY table_schema;" >> $SCRIPT_DIR/output/$OUTPUT_DB_FILE

# Generate list for projects
shopt -s extglob

function trim_string () {
  string="${1##*( )}"
  echo "${string%%*( )}"
}

# Reset file
echo > $SCRIPT_DIR/output/$OUTPUT_PROJECTS_FILE

# Loop sub directories and get size
for PROJECT_DIR in $PROJECTS_DIR
do
  # Todo: ignore empty
  # dir=${PROJECT_DIR%*/}
  name=$(trim_string ${PROJECT_DIR##*/})
  human_size=$(trim_string $(du -hs "$PROJECT_DIR" | cut -f1))
  sortable_size=$(trim_string $(du -hsk "$PROJECT_DIR" | cut -f1))

  # Write to file
  echo $name,$sortable_size,$human_size >> $SCRIPT_DIR/output/$OUTPUT_PROJECTS_FILE
done

shopt -u extglob

exit 0
