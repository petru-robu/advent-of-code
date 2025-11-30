mat = []    

def check_X_at_pos(i, j):
    if i >= 1 and j >= 1 and i<= len(mat) - 2 and j <= len(mat[0]) -2:
        diag1 = mat[i-1][j-1] + mat[i][j] + mat[i+1][j+1]
        diag2 = mat[i-1][j+1] + mat[i][j] + mat[i+1][j-1]

        options = ['MAS', 'SAM']

        if diag1 in options and diag2 in options:
            return True
        
        return False
    else:
        return False

def check_X():
    cnt = 0
    for i in range(len(mat)):
        for j in range(len(mat[0])):
            if check_X_at_pos(i, j):
                cnt += 1
    return cnt

if __name__ == '__main__':
    f = open('input.txt', 'r')

    for line in f.readlines():
        mat.append(list(line.strip()))

    print(check_X())
