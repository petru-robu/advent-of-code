mat = []

def check_horizontal(word):
    cnt = 0
    for i in range(len(mat)):
        line_str = ''.join(mat[i])
        cnt += line_str.count(word)

    return cnt
    
def check_vertical(word):
    cnt = 0
    for j in range(len(mat[0])):
        l = []
        for i in range(len(mat)):
        
            l.append(mat[i][j])
        line_str = ''.join(l)
        #print(line_str)
        cnt += line_str.count(word)
    
    return cnt
    

def check_diag_pos(word, i, j):
    diag1, diag2 = '', ''

    if i+3 < len(mat) and j+3 < len(mat[0]):
        diag1 = mat[i][j] + mat[i+1][j+1] + mat[i+2][j+2] + mat[i+3][j+3]
    
    if i+3 < len(mat) and j-3 >= 0:
        diag2 = mat[i][j] + mat[i+1][j-1] + mat[i+2][j-2] + mat[i+3][j-3]

    cnt = 0

    if diag1 == word:
        cnt += 1

    if diag2 == word:
        cnt += 1
    return cnt

def check_diagonal(word):
    cnt = 0
    for i in range(len(mat)):
        for j in range(len(mat[0])):
            cnt += check_diag_pos(word, i, j)
    return cnt

if __name__ == '__main__':
    f = open('input.txt', 'r')

    for line in f.readlines():
        mat.append(list(line.strip()))

    ans = 0
    ans += check_vertical('XMAS')
    ans += check_horizontal('XMAS')
    ans += check_vertical('SAMX')
    ans += check_horizontal('SAMX')
    ans += check_diagonal('XMAS')
    ans += check_diagonal('SAMX')


    print(ans)
