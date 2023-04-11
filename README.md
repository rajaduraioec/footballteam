1. Added database seeder for creating manager and admin users. Admin can create, update & delete the teams and players whereas manager can not. 
2. Created code field in teams and players table since I do not want to expose the id. So update and delete operations will be done through code. 
3. Normally I use snake_case for database columns but becuase the requirements had camelcase fields I dediced to fo with camelcase for database. 
4. I can do the same opeatations with repository design pattern but for this requirement I felt these is no need to use it. 
