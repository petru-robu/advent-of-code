
def check_seq(v):
    inc = False
    if v[0] - v[1] < 0:
        inc = True

    ok, idx = True, -1
    if inc:
        for i in range(1, len(v)):
            if v[i] - v[i-1] < 1 or v[i] - v[i-1] > 3:
                idx = i
                ok = False
                break
    else:
        for i in range(1, len(v)):
            if v[i-1] - v[i] < 1 or v[i-1] - v[i] > 3:
                idx = i
                ok = False
                break

    if ok:
        return -1
    else:
        return idx

    
if __name__ == '__main__':
    f = open('input.txt', 'r')

    cnt = 0

    for line in f:
        v = [int(x) for x in line.split()]

        c = check_seq(v)
        if c == -1:
            cnt += 1
        else:
            for i in range(len(v)):
                u = v.copy()
                del u[i]
                if check_seq(u) == -1:
                    cnt += 1
                    break

    print(cnt)
    