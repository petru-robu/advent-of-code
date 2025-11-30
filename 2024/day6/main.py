f = open('in2.in', 'r')

mat = []
startPos = [0,0]

def isLoop():
    #UP->RIGHT->DOWN->LEFT->UP

    dir = 'UP' 
    insideMap = True

    currPos = [-1, -1]
    currPos[0] = startPos[0]
    currPos[1] = startPos[1]
    cnt = 0

    positions = {}

    while insideMap:
        if dir == 'UP':
            i, j = currPos
            while i >= 0 and mat[i][j] != '#':
                if (i, j) not in positions:
                    positions[(i,j)] = 1
                else:
                    positions[(i,j)] += 1
                    if positions[(i,j)] >= 4:
                        return True
                    
                i -= 1
            
            if i == -1:
                insideMap = False
                break
            else:
                i += 1
                dir = 'RIGHT'
                currPos[0] = i
                currPos[1] = j

        elif dir == 'RIGHT':
            i, j = currPos
            while j <= len(mat[0])-1 and mat[i][j] != '#':
                if (i, j) not in positions:
                    positions[(i,j)] = 1
                else:
                    positions[(i,j)] += 1
                    if positions[(i,j)] >= 4:
                        return True
                j += 1
        
            if j == len(mat[0]):
                insideMap = False
                break
            else:
                j -= 1
                dir = 'DOWN'
                currPos[0] = i
                currPos[1] = j

        elif dir == 'DOWN':
            i, j = currPos
            while i <= len(mat)-1 and mat[i][j] != '#':
                if (i, j) not in positions:
                    positions[(i,j)] = 1
                else:
                    positions[(i,j)] += 1
                    if positions[(i,j)] >= 4:
                        return True
                i += 1

            if i == len(mat):
                insideMap = False 
                break
            else:
                i -= 1
                dir = 'LEFT'
                currPos[0] = i
                currPos[1] = j

        elif dir == 'LEFT':
            i, j = currPos
            while j >= 0 and mat[i][j] != '#':
                if (i, j) not in positions:
                    positions[(i,j)] = 1
                else:
                    positions[(i,j)] += 1
                    if positions[(i,j)] >= 4:
                        return True
                j -= 1

            if j == -1:
                insideMap = False
                break
            else:
                j += 1
                dir = 'UP'
                currPos[0] = i
                currPos[1] = j

    return False


if __name__ == '__main__':

    for line in f.readlines():
        mat.append([ch for ch in line.strip()])
    
    for i in range(0, len(mat)):
        for j in range(0, len(mat[0])):
            if mat[i][j] == '^':
                startPos = [i, j]
                break

    ans = 0

    




    for i in range(0, len(mat)):
        for j in range(0, len(mat[0])):
            if mat[i][j] == '.':
                mat[i][j] = '#'
                if isLoop():
                    ans += 1
                mat[i][j] = '.'
    
    print(ans)

