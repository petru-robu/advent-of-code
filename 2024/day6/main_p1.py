f = open('in2.in', 'r')

mat = []
visited = set()

if __name__ == '__main__':

    for line in f.readlines():
        mat.append([ch for ch in line.strip()])
    
    currPos = [-1, -1]
    for i in range(0, len(mat)):
        for j in range(0, len(mat[0])):
            if mat[i][j] == '^':
                currPos = [i, j]

    print(currPos)

    dir = 'UP' #UP->RIGHT->DOWN->LEFT->UP
    insideMap = True

    while insideMap:
        if dir == 'UP':
            i, j = currPos
            while i >= 0 and mat[i][j] != '#':
                visited.add((i, j))
                i -= 1
            
            if i == -1:
                insideMap = False
                break
            else:
                i += 1
                dir = 'RIGHT'
                currPos[0] = i
                currPos[1] = j
                print(i, j, dir)

        elif dir == 'RIGHT':
            i, j = currPos
            while j <= len(mat[0])-1 and mat[i][j] != '#':
                visited.add((i, j))
                j += 1
        
            if j == len(mat[0]):
                insideMap = False
                break
            else:
                j -= 1
                dir = 'DOWN'
                currPos[0] = i
                currPos[1] = j
                print(i, j, dir)

        elif dir == 'DOWN':
            i, j = currPos
            while i <= len(mat)-1 and mat[i][j] != '#':
                visited.add((i, j))
                i += 1

            if i == len(mat):
                insideMap = False 
                break
            else:
                i -= 1
                dir = 'LEFT'
                currPos[0] = i
                currPos[1] = j
                print(i, j, dir)

        elif dir == 'LEFT':
            i, j = currPos
            while j >= 0 and mat[i][j] != '#':
                visited.add((i, j))
                j -= 1

            if j == -1:
                insideMap = False
                break
            else:
                j += 1
                dir = 'UP'
                currPos[0] = i
                currPos[1] = j
                print(i, j, dir)


    print(len(visited))

    for el in visited:
        i, j = el
        mat[i][j] = 'X'

    for line in mat:
        print(''.join(line))




    
