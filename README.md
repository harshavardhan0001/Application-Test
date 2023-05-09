-- Run backend --
1. composer install
2. php -S localhost:8000
3. ng test
----------------------
-- Run frontend --
1. npm install
2. ng serve
3. php vendor/bin/codecept run tests/unit
-----------------------
## Application Version
1. Frontend - Anguar 10+
2. Backend - PHP 7.2+
3. included npm modules .
4. Frontend built using npm, backend raw php files.

## Backend 
1. The backend will provide data to the frontend through a RESTful API
2. The API will allow GET requests for getting all records. 
3. The API will allow POST requests for save, update, and delete.  
4. The API response will be JSON formatted data.
5. The data will be read from a provided data file.

## Frontend
1. Data will be displayed in a table view.
2. Each column header in the table will correspond to a field name in the data file.
3. Allowed each row and field to be edited.
4. Allowed record creation and deletion, either inline or modal.
  
## Data
1. Data will be provided as csv text file.
2. The fist row of the data file will contain the field names.

## Tests
1. Codeception - API tests included for backend.
2. ng test - Unit test to load Ag grid
  
	
