import redis

r = redis.Redis(host='localhost', port=6380, db=0)

def hash_example():
	r.hset('user:2000', 'name', 'Alice')
	r.hset('user:2000', 'age', 30)
	r.hset('user:2000', 'email', 'alice@exemplo.com.br')

	user = r.hgetall('user:2000')
	print(f"Hash - User: {user}")

	r.hset('user:2000', 'age', 32)

	age = r.hget('user:2000', 'age')
	print(f"Updated Age: {age}")

def list_example():
	r.rpush('tasks', 'task1')
	r.rpush('tasks', 'task2')
	r.rpush('tasks', 'task3')

	tasks = r.lrange('tasks', 0, -1)
	print(f"Exemplo Lista - Tasks: {tasks}")

	task = r.lpop('tasks')
	print(f"Popped Task: {task}")

	size = r.llen('tasks')
	print(f"List Size: {size}")

def set_example():
	r.sadd('tags', 'python')
	r.sadd('tags', 'redis')
	r.sadd('tags', 'database')

	tags = r.smembers('tags')
	print(f"Set Example - Tags: {tags}")

	is_member = r.sismember('tags', 'python')
	print(f"Is 'python' a member of tags? {is_member}")

	r.srem('tags', 'database')

def sorted_set_example():
	r.zadd('leaderboard', {'Alice': 100, 'Bob': 200, 'Charlie': 150})

	leaderboard = r.zrange('leaderboard', 0, -1, withscores=True)
	print(f"Sorted Set Example - Leaderboard: {leaderboard}")

	r.zincrby('leaderboard', 50, 'Alice')

	score = r.zscore('leaderboard', 'Alice')
	print(f"Alice's Updated Score: {score}")

	top_players = r.zrangebyscore('leaderboard', 100, 200, withscores=True)
	print(f"Top Players: {top_players}")

hash_example()
list_example()
set_example()
sorted_set_example()