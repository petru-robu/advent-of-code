from collections import defaultdict

f = open('3.in', 'r')

def print_mat(grid):
    for i in range(0, len(grid)):
        for j in range(0, len(grid[0])):
            print(grid[i][j], end="")
        print()

if __name__ == '__main__':
    grid, directions = f.read().split('\n\n')
    grid = [list(row) for row in grid.split('\n')]
    n, m = len(grid), len(grid[0])

    for i in range(0, n):
        for j in reversed(range(0, m)):
            if grid[i][j] == '#':
                grid[i].insert(j, '#')
            if grid[i][j] == '.':
                grid[i].insert(j, '.')
            if grid[i][j] == '@':
                robot = i, j*2
                grid[i][j:j+1] = ['.', '.']
            if grid[i][j] == 'O':
                grid[i][j:j+1] = ['[', ']']

    print_mat(grid)

    for d in directions:
        i, j = robot
        if d == '<':
            k = j-1
            while grid[i][k] == ']':
                k -= 2
            if grid[i][k] == '.':
                for l in range(k, j):
                    grid[i][l] = grid[i][l+1]
                robot = i, j-1

        elif d == '>':
            k = j+1
            while grid[i][k] == '[':
                k += 2
            if grid[i][k] == '.':
                for l in reversed(range(j+1, k+1)):
                    grid[i][l] = grid[i][l-1]
                robot = i, j+1

        elif d == '^':
            q = {(i-1, j)}
            rows = defaultdict(set)

            while q:
                x, y = q.pop()
                if grid[x][y] == '#':
                    break
                elif grid[x][y] == ']':
                    rows[x] |= {y-1, y}
                    q |= {(x-1, y), (x-1, y-1)}
                elif grid[x][y] == '[':
                    rows[x] |= {(y, y+1)}
                    q |= {(x-1,y), (x-1, y+1)}
                elif grid[x][y] == '.':
                    rows[x].add(y)
            else:
                for x in sorted(rows):
                    for y in rows[x]:
                        grid[x][y] = grid[x+1][y]

        elif d == 'v':
            pass



    total = 0
    for i in range(n):
        for j in range(2*m):
            if grid[i][j] == '[':
                total += 100*i + j
    
    print(total)